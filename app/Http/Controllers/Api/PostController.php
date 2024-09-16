<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ExceptionFactory;
use App\Exceptions\PostException;
use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Api\Post\IndexRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index(IndexRequest $indexRequest): array
    {
        $data = $indexRequest->validated();
        $posts = Post::filter($data)->get();
        return PostResource::collection($posts)->resolve();
    }

    public function show(Post $post): array
    {
        return PostResource::make($post)->resolve();
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $post = PostService::create($data);
        return PostResource::make($post)->resolve();
    }

    public function update(Post $post, UpdateRequest $request): array
    {
        $data = $request->validated();
        $post = PostService::update($data, $post);
        return PostResource::make($post)->resolve();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response([
            'message' => 'post deleted',
        ], Response::HTTP_OK);
    }

    public function restore($id): array
    {
        $post = Post::withTrashed()->findOrFail($id);

        if ($post->trashed()) {
            $post->restore();
        }

        return PostResource::make($post)->resolve();
    }

    /**
     * @throws \Exception
     */
    public function process(): void
    {
        $title = 'updated22';
        $post = Post::query()->firstOrCreate(['title' => $title],
            [
                'profile_id' => 1,
                'category_id' => 3,
            ],
        );

//        PostException::checkIfPostExists($post);
        ExceptionFactory::create($post, 'firstOrCreate');
    }

    /**
     * @throws \Exception
     */
    public function updatePost(): void
    {
        $title = 'updated444';
        $post = Post::query()->updateOrCreate([
            'title' => $title
        ], [
            'profile_id' => 2,
            'category_id' => 3,
            'description' => 'updated description',
        ]);

        ExceptionFactory::create($post, 'updateOrCreate');
    }
}
