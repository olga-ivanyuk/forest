<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
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
}
