<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index(): array
    {
        return PostResource::collection(Post::all())->resolve();
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

    public function update(Post $post, UpdateRequest $request)
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
}
