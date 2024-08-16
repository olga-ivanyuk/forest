<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagResource;
use App\Models\Profile;
use App\Models\Tag;
use App\Services\ProfileService;
use App\Services\TagService;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function index(): array
    {
        return TagResource::collection(Tag::all())->resolve();
    }

    public function show(Tag $tag): array
    {
        return TagResource::make($tag)->resolve();
    }

    public function store()
    {
        $data = [
            'title' => 'tag5',
        ];

        return ProfileService::create($data);
    }

    public function update(Tag $tag)
    {
        $data = [
            'title' => 'tag6',
        ];

        return TagService::update($data, $tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response([
            'message' => 'tag deleted',
        ], Response::HTTP_OK);
    }
}
