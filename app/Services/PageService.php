<?php

namespace App\Services;

use App\Models\Page as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageService
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }




    public function getPaginate($length = 10, $with = [], $withCount = [])
    {
        return $this->model->with($with)->withCount($withCount)->paginate($length);
    }

    public function findBySlug($slug)
    {
        return $this->model->where("slug", $slug)->firstOrFail();
    }


    public function store($request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $model = $this->model->create($data);
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


}
