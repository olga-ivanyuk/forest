<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index(): array
    {
        return UserResource::collection(Post::all())->resolve();
    }

    public function show(Post $post): array
    {
        return UserResource::make($post)->resolve();
    }

    public function store(): array
    {
        $data = [
            'title' => 'my new post',
        ];
        $post = PostService::create($data);

        return UserResource::make($post)->resolve();
    }

    public function update(Post $post): array
    {
        $data = [
            'title' => 'My post',
        ];
        $post = PostService::update($data, $post);

        return UserResource::make($post)->resolve();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response([
            'message' => 'post deleted',
        ], Response::HTTP_OK);
    }
}
