<?php

namespace App\Services;

use App\Models\Zip as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZipService
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getPaginate($length = 10, $with=["user"], $withCount=["files"])
    {
        return $this->model->with($with)->withCount($withCount)->latest()->paginate($length);
    }

    public function getFilesPaginate($id , $request, $length = 1)
    {
        $model = $this->model->findOrFail($id);
        $query = $model->files()->filters($request);
        return $query->paginate($length)->withQueryString();
    }

    public function store($request)
    {
        $data = [
            "user_id" => auth()->id() ,
            "size"    => $request->zip->getSize() ,
            "name"    => getFileName($request->zip)
        ];

        DB::beginTransaction();

        try {
            $model = $this->model->create($data);
            $model->update(["path" => uploadResource($request->zip, "zips/" . $model->id)]);
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


}
