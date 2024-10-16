<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(): \Inertia\Response
    {
        $categories = Category::all();
        $categories = CategoryResource::collection($categories)->resolve();

        return Inertia::render('Admin/Category/Index', compact('categories'));
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Admin/Category/Create');
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $category = CategoryService::create($data);

        return CategoryResource::make($category)->resolve();
    }
}
