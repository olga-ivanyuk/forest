<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(): array
    {
        return CategoryResource::collection(Category::all())->resolve();
    }

    public function show(Category $category): array
    {
        return CategoryResource::make($category)->resolve();
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $category = CategoryService::create($data);
        return CategoryResource::make($category)->resolve();
    }

    public function update(Category $category, UpdateRequest $request): array
    {
        $data = $request->validated();
        $category = CategoryService::update($data, $category);
        return CategoryResource::make($category)->resolve();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response([
            'message' => 'category deleted',
        ], Response::HTTP_OK);
    }
}
