<?php

namespace App\Observers;

use App\Events\Post\LoggingFinishedEvent;
use App\Events\Post\LoggingStartedEvent;
use App\LogFormatter\PostLogFormatter;
use App\Models\Log;
use App\Models\Post;

class PostObserver
{
    public function retrieved(Post $post): void
    {
//       LoggingStartedEvent::dispatch($post);

//        Log::query()->create([
//            'model_id' => $post->id,
//            'event_name' => 'retrieved',
//            'old_attributes' => null,
//            'new_attributes' => json_encode($post->getAttributes()),
//            'changed_at' => now(),
//        ]);
//
//        LoggingFinishedEvent::dispatch($post);

        $this->logAction('retrieved', $post);
//        \Illuminate\Support\Facades\Log::channel('posts')->info('post {id} retrieved', ['id' => $post->id]);
    }

    public function created(Post $post): void
    {
//        LoggingStartedEvent::dispatch($post);
//
//        Log::query()->create([
//            'model_id' => $post->id,
//            'event_name' => 'created',
//            'old_attributes' => null,
//            'new_attributes' => json_encode($post->getAttributes()),
//            'changed_at' => now(),
//        ]);
//
//        LoggingFinishedEvent::dispatch($post);

//        $this->logAction('created', $post);
    }

    public function updated(Post $post): void
    {
//        LoggingStartedEvent::dispatch($post);
////        dd($post->getOriginal(), $post->toArray());
//
//        Log::query()->create([
//            'model_id' => $post->id,
//            'event_name' => 'updated',
//            'old_attributes' => json_encode($post->getOriginal()),
//            'new_attributes' => json_encode($post->getDirty()),
//            'changed_at' => now(),
//        ]);
//
//        LoggingFinishedEvent::dispatch($post);

        $this->logAction('updated', $post);
    }

    public function deleted(Post $post): void
    {
//        LoggingStartedEvent::dispatch($post);
//
//        Log::query()->create([
//            'model_id' => $post->id,
//            'event_name' => 'deleted',
//            'old_attributes' => json_encode($post->getAttributes()),
//            'new_attributes' => null,
//            'changed_at' => now(),
//        ]);
//
//        LoggingFinishedEvent::dispatch($post);

        $this->logAction('deleted', $post);
    }

    protected function logAction(string $action, Post $post): void
    {
        $logPath = storage_path("logs/post/{$action}.log");

        \Illuminate\Support\Facades\Log::build([
            'driver' => 'single',
            'tap' => [PostLogFormatter::class], //??
            'path' => $logPath,
            'replace_placeholders' => true,
        ])->info("Post {$action}: ", ['id' => $post->id, 'title' => $post->title]);
    }
}
