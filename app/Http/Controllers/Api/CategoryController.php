<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ExceptionFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\IndexRequest;
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
    public function index(IndexRequest $indexRequest): array
    {
        $data = $indexRequest->validated();
        $categories = Category::filter($data)->get();
        return CategoryResource::collection($categories)->resolve();
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

    /**
     * @throws \Exception
     */
    public function processCategory(): void
    {
        $title = 'non_new_11';
        $category = Category::query()->firstOrCreate(['title' => $title],
            [
                'title' => $title
            ],
        );

        ExceptionFactory::create($category, 'firstOrCreate');
    }

    /**
     * @throws \Exception
     */
    public function updateCategory(): void
    {
        $title = 'a';
        $category = Category::query()->updateOrCreate([
            'title' => $title
        ], [
            'title' => 'aaaaaaaaaaaaaaa'
        ]);

        ExceptionFactory::create($category, 'updateOrCreate');
    }
}
