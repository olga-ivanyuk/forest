<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
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

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $comment = CommentService::create($data);
        return CommentResource::make($comment)->resolve();
    }

    public function update(Comment $comment, UpdateRequest $request): array
    {
        $data = $request->validated();
        $comment = CommentService::update($data, $comment);
        return CommentResource::make($comment)->resolve();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response([
            'message' => 'comment deleted',
        ], Response::HTTP_OK);
    }
}
