<?php

namespace App\Http\Controllers;

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

    public function store(): array
    {
        $data = [
            'title' => 'my new post',
        ];
        $post = PostService::create($data);

        return PostResource::make($post)->resolve();
    }

    public function update(Post $post)
    {
        $data = [
            'title' => 'My post',
        ];
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
