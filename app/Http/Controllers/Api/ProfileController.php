<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\StoreRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
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
