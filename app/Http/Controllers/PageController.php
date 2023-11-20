<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PageService;
use App\Http\Requests\Page\PageRequest;

class PageController extends Controller
{
    public $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index(Request $request)
    {
        $models = $this->pageService->getPaginate();
        return view("pages.index", ["models" => $models]);
    }

    public function create(Request $request)
    {
        return view("pages.create");
    }

    public function store(PageRequest $request)
    {
        $model = $this->pageService->store($request);
        return back()->withMessage("Created Success");
    }

    public function show(Request $request, $slug)
    {
        $model = $this->pageService->findBySlug($slug);

        return view("pages.show", ["model" => $model]);
    }
}
