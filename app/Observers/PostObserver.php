<?php

namespace App\Observers;

use App\Events\Post\LoggingFinishedEvent;
use App\Events\Post\LoggingStartedEvent;
use App\Models\Log;
use App\Models\Post;

class PostObserver
{
    public function retrieved(Post $post): void
    {
//       LoggingStartedEvent::dispatch($post);

        Log::query()->create([
            'model_id' => $post->id,
            'event_name' => 'retrieved',
            'old_attributes' => null,
            'new_attributes' => json_encode($post->getAttributes()),
            'changed_at' => now(),
        ]);

        LoggingFinishedEvent::dispatch($post);
    }

    public function created(Post $post): void
    {
        LoggingStartedEvent::dispatch($post);

        Log::query()->create([
            'model_id' => $post->id,
            'event_name' => 'created',
            'old_attributes' => null,
            'new_attributes' => json_encode($post->getAttributes()),
            'changed_at' => now(),
        ]);

        LoggingFinishedEvent::dispatch($post);
    }

    public function updated(Post $post): void
    {
        LoggingStartedEvent::dispatch($post);
//        dd($post->getOriginal(), $post->toArray());

        Log::query()->create([
            'model_id' => $post->id,
            'event_name' => 'updated',
            'old_attributes' => json_encode($post->getOriginal()),
            'new_attributes' => json_encode($post->getDirty()),
            'changed_at' => now(),
        ]);

        LoggingFinishedEvent::dispatch($post);
    }

    public function deleted(Post $post): void
    {
        LoggingStartedEvent::dispatch($post);

        Log::query()->create([
            'model_id' => $post->id,
            'event_name' => 'deleted',
            'old_attributes' => json_encode($post->getAttributes()),
            'new_attributes' => null,
            'changed_at' => now(),
        ]);

        LoggingFinishedEvent::dispatch($post);
    }
}
