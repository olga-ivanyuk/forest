<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function main(Request $request): Response
    {
        $posts = Post::query()->where('profile_id', $request->user()->profile->id)->orderBy('created_at', 'desc')->get();
        $comments = Comment::query()->where('profile_id', $request->user()->profile->id)
            ->with('post')
            ->orderBy('created_at', 'desc')
            ->get();

        $user = Auth::user();

        $likedPosts = auth()->user()->profile->likedPosts()->get();
        $likedComments = auth()->user()->profile->likedComments()->get();

        return inertia::render('Profile/Main', [
            'posts' => $posts,
            'user' => $user,
            'comments' => $comments,
            'likedPosts' => $likedPosts,
            'likedComments' => $likedComments,
        ]);
    }

    public function fetchUserPosts(Request $request): \Illuminate\Http\JsonResponse
    {
        $posts = Post::query()->where('profile_id', $request->user()->profile->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['posts' => $posts]);
    }
}
