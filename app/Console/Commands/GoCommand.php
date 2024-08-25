<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GoCommand extends Command
{
    protected $signature = 'go';
    protected $description = 'Command description';

    public function handle(): void
    {
        // One to One (Polymorphic) Image-Profile-User-Post
        $profile = Profile::query()->first();
        $user = User::query()->first();
        $post = Post::query()->first();

        $image_profile = $profile->image();
        $image_user = $user->image();
        $image_post = $post->image();

        $image = Image::query()->first(); //Retrieving
        $imageable = $image->imageable;
//        dd($image_profile, $image_user, $image_post);
//        dd($imageable);

        // One to Many (Polymorphic) Comment-Post-Video
        $post = Post::query()->first();
        $video = Video::query()->first();
        $comments_post = $post->comments();
        $comments_video = $video->comments();
        $comment = Comment::query()->first();
        $comments = $comment->commentable();

//        dd($comments_post);
//        dd($comments);

        //  Many to Many (Polymorphic) Like-Comment-Post
        $post = Post::find(4);
        $profile = Profile::query()->first();
        dd($post->likedProfiles());
//        dd($profile->likedPost);
    }
}
