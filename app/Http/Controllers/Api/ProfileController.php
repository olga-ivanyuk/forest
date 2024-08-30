<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\IndexRequest;
use App\Http\Requests\Profile\StoreRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Comment;
use App\Models\Profile;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function index(IndexRequest $indexRequest): array
    {
        $data = $indexRequest->validated();
        $profiles = Profile::filter($data)->get();
        return ProfileResource::collection($profiles)->resolve();
    }

    public function show(Profile $profile): array
    {
        return ProfileResource::make($profile)->resolve();
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $profile = ProfileService::create($data);
        return ProfileResource::make($profile)->resolve();
    }

    public function update(Profile $profile, UpdateRequest $request): array
    {
        $data = $request->validated();
        $profile = ProfileService::update($data, $profile);
        return ProfileResource::make($profile)->resolve();
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return response([
            'message' => 'profile deleted',
        ], Response::HTTP_OK);
    }
}
