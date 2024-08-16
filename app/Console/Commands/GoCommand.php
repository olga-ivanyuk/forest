<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Console\Command;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $post = Post::query()->first();
        dd($post->likedByProfiles);
//        Post::query()
//            ->create([
//            'title' => 'My title 3',
//        ]);

//        Category::query()
//            ->create([
//                'title' => 'My 3 title category',
//            ]);

//        Comment::query()
//            ->create([
//                'content' => 'My 4 content',
//            ]);

//        Profile::query()
//            ->create([
//                'birthed_at' => '1996-12-02',
//            ]);

//        Tag::query()
//            ->create([
//                'title' => 'tag1',
//            ]);

//        $post = Post::query()->find(1);

//        $post->update([
//            'title' => 'My title 2',
//            ]);
//        $post->delete();
//        dd($post);
    }
}
