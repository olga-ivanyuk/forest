<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;
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

    public function store()
    {
        $data = [
            'title' => 'my new category',
        ];

        return CategoryService::create($data);
    }

    public function update(Category $category)
    {
        $data = [
            'title' => 'my 1 category',
        ];

        return CategoryService::update($data, $category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response([
            'message' => 'category deleted',
        ], Response::HTTP_OK);
    }
}
