<?php

namespace App\Http\Controllers;

use App\Services\ZipService;
use Illuminate\Http\Request;
use App\Http\Requests\Zip\ZipRequest;
use App\Models\Zip;

class ZipController extends Controller
{
    public $zipService;

    public function __construct(ZipService $zipService)
    {
        $this->zipService = $zipService;
    }

    public function index(Request $request)
    {
        $models = $this->zipService->getPaginate();
        return view("zip.index", ["models" => $models]);
    }

    public function create(Request $request)
    {
        return view("zip.create");
    }

    public function store(ZipRequest $request)
    {
        $model = $this->zipService->store($request);
        dispatch_sync(new \App\Jobs\ZipProcessing($model));
        return back()->withMessage("Upload Success and will notify when be handled it ");
    }

    public function show(Request $request, $zip)
    {
        $models = $this->zipService->getFilesPaginate($zip, $request);
        return view("zip.show", ["models" => $models]);
    }


}
