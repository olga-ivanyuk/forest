<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CommentResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Comment;
use App\Models\Profile;
use App\Services\CommentService;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function index(): array
    {
        return ProfileResource::collection(Profile::all())->resolve();
    }

    public function show(Profile $profile): array
    {
        return ProfileResource::make($profile)->resolve();
    }

    public function store()
    {
        $data = [
            'birthed_at' => '1997-12-02',
        ];

        return ProfileService::create($data);
    }

    public function update(Profile $profile)
    {
        $data = [
            'birthed_at' => '1997-12-13',
        ];

        return ProfileService::update($data, $profile);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return response([
            'message' => 'profile deleted',
        ], Response::HTTP_OK);
    }
}
