<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\StoreCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Post\PostResource;
use App\Mail\Comment\StoredCommentEmail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validationData();

        $posts = PostResource::collection(
            Post::filter($data)
                ->orderBy('created_at', 'desc')
                ->paginate($data['per_page'], ['*'], 'page', $data['page'])
        );

        if ($request->wantsJson()) {
            return $posts;
        }

        return Inertia::render('Home/Index', compact('posts'));
    }

    public function show(Post $post): \Inertia\Response
    {
        $post = PostResource::make($post)->resolve();

        return inertia('Home/Show', compact('post'));
    }

    public function storeComment(Post $post, StoreCommentRequest $request): array
    {
        $data = $request->validationData();
        $comment = $post->comments()->create($data);
        $postUrl = route('posts.show', $post->id);
        Mail::to($post->profile->user)->send(new StoredCommentEmail($post->profile, $comment, $postUrl));

        return CommentResource::make($comment)->resolve();
    }

    public function storeChildComment(Post $post, Comment $comment, StoreCommentRequest $request): array
    {
        $data = $request->validationData();
        $postUrl = route('posts.show', $post->id);
        $childComment = $post->comments()->create($data);
        Mail::to($post->profile->user)->send(new StoredCommentEmail($post->profile, $childComment, $postUrl));

        return CommentResource::make($childComment)->resolve();
    }
}
