<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tag\IndexRequest;
use App\Http\Requests\Tag\StoreRequest;
use App\Http\Requests\Tag\UpdateRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Profile;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function index(IndexRequest $indexRequest): array
    {
        $data = $indexRequest->validated();
        $tags = Tag::filter($data)->get();
        return TagResource::collection($tags)->resolve();
    }

    public function show(Tag $tag): array
    {
        return TagResource::make($tag)->resolve();
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $tag = TagService::create($data);
        return TagResource::make($tag)->resolve();
    }

    public function update(Tag $tag, UpdateRequest $request): array
    {
        $data = $request->validated();
        $tag = TagService::update($data, $tag);
        return TagResource::make($tag)->resolve();
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response([
            'message' => 'tag deleted',
        ], Response::HTTP_OK);
    }
}
