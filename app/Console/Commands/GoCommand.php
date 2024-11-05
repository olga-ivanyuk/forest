<?php

namespace App\Console\Commands;

use App\Events\Post\LoggingStartedEvent;
use App\Mail\Comment\StoredCommentEmail;
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
use Illuminate\Support\Facades\Mail;

class GoCommand extends Command
{
    protected $signature = 'go';
    protected $description = 'Command description';

    public function handle(): void
    {
//        $user = User::query()->find(5);
//
//        Mail::to($user)->send(new StoredCommentEmail());
    }
}
