<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\IndexRequest;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validationData();
        $categories = CategoryResource::collection(Category::all())->resolve();
        $tags = TagResource::collection(Tag::all())->resolve();
        $posts = PostResource::collection(
            Post::filter($data)
                ->orderBy('created_at', 'desc')
                ->paginate($data['per_page'], ['*'], 'page', $data['page'])
        );

        if ($request->wantsJson()) {
            return $posts;
        }

        return Inertia::render('Admin/Post/Index', compact('posts', 'categories', 'tags'));
    }

    public function create(): \Inertia\Response
    {
        $categories = CategoryResource::collection(Category::all())->resolve();

        return Inertia::render('Admin/Post/Create', compact('categories'));
    }

    public function show(Post $post): \Inertia\Response
    {
        $post = PostResource::make($post)->resolve();

        return inertia('Admin/Post/Show', compact('post'));
    }

    /**
     * @throws \Exception
     */
    public function store(StoreRequest $request): array
    {
        $data = $request->validationData();
        $post = PostService::create($data);
        return PostResource::make($post)->resolve();
    }

    /**
     * @throws \Exception
     */
    public function update(UpdateRequest $request, Post $post): array
    {
        $data = $request->validationData();
        $post = PostService::update($data, $post);

        return PostResource::make($post)->resolve();
    }

    public function destroy(Post $post): \Illuminate\Http\JsonResponse
    {
        PostService::delete($post);

        return response()->json([
            'message' => __('The post was successfully deleted.'),
        ]);
    }
}
