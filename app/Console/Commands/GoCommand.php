<?php

namespace App\Console\Commands;

use App\Events\Post\LoggingStartedEvent;
use App\Mail\Comment\StoredCommentEmail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class GoCommand extends Command
{
    protected $signature = 'user:create-admin';
    protected $description = 'Create a new admin user';

    public function handle(): void
    {
        $email = $this->ask('Enter admin email');
        $password = $this->ask('Enter admin password');

        $user = User::query()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $role = Role::query()->where('name', 'super_admin')->first();
        $user->roles()->attach($role->id);

        $this->info('Admin user created successfully.');
    }
}
