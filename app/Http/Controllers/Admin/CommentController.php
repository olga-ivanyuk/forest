<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\StoreRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\UserResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Services\CommentService;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index(): \Inertia\Response
    {
        $comments = CommentResource::collection(Comment::all())->resolve();

        return Inertia::render('Admin/Comment/Index', compact('comments'));
    }

    public function create(): \Inertia\Response
    {
        $posts = PostResource::collection(Post::all())->resolve();
        $profiles = ProfileResource::collection(Profile::all())->resolve();

        return Inertia::render('Admin/Comment/Create', compact('posts', 'profiles'));
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $comment = CommentService::create($data);

        return CommentResource::make($comment)->resolve();
    }
}
