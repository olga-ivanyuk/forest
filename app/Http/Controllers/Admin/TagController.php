<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use App\Services\CategoryService;
use App\Services\TagService;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index(): \Inertia\Response
    {
        $tags = Tag::all();
        $tags = TagResource::collection($tags)->resolve();
        return Inertia::render('Admin/Tag/Index', compact('tags'));
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Admin/Tag/Create');
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $tag = TagService::create($data);

        return TagResource::make($tag)->resolve();
    }
}
