<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function index(): array
    {
        return CommentResource::collection(Comment::all())->resolve();
    }

    public function show(Comment $comment): array
    {
        return CommentResource::make($comment)->resolve();
    }

    public function store()
    {
        $data = [
            'content' => 'my new content',
        ];

        return CommentService::create($data);
    }

    public function update(Comment $comment)
    {
        $data = [
            'content' => 'my updated content',
        ];

        return CommentService::update($data, $comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response([
            'message' => 'comment deleted',
        ], Response::HTTP_OK);
    }

    public function commentToggleLike(Post $post, $id)
    {
        $res = auth()->user()->profile->likedComments()->toggle($id);
        $comment = Comment::query()->findOrFail($id);

        return response()->json([
            'is_liked' => count($res['attached']) > 0,
            'liked_profiles_count' => $comment->likedProfiles()->count(),
        ]);
    }
}
