<?php

namespace App\Jobs;

use App\Models\Zip;
use ZipArchive;
use Illuminate\Bus\Queueable;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ZipProcessing implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $zip;
    /**
     * Create a new job instance.
     */
    public function __construct($zip)
    {

        $this->zip = $zip;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $zip = new ZipArchive();
        $status = $zip->open(getFullPath($this->zip->path));
        if ($status !== true) {
            throw new \Exception($status);
        }

        $unzipPath = $this->getUnzipPath();
        createFolder($unzipPath);
        $zip->extractTo(getFullPath($unzipPath));
        $zip->close();
        $this->storeFileAfterExtractInDatabase();


    }

    public function getUnzipPath()
    {
        return "zips/" . $this->zip->id . "/unzip";
    }

    public function storeFileAfterExtractInDatabase()
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(getFullPath($this->getUnzipPath())), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $fileInfo) {

            if ($fileInfo->isFile()) {
                $this->zip->files()->updateOrCreate([
                      "path" => str_replace(getFullPath(""), "", $fileInfo->getRealPath())
                  ], [
                      "name" =>  explode('.', $fileInfo->getFileName())[0] ,
                      "type" => $fileInfo->getType(),
                      "extension" => $fileInfo->getExtension(),
                      "size"    => $fileInfo->getSize(),
                      "location" => str_replace(getFullPath($this->getUnzipPath()), "", $fileInfo->getPath())

                  ]);
            }
        }
        $this->zip->update(["status" => Zip::STATUS_DONE]);
    }
}
