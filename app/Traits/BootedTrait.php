<?php

namespace App\Traits;

use App\Events\Post\LoggingFinishedEvent;
use App\Events\Post\LoggingStartedEvent;
use App\Models\Log;

trait BootedTrait
{
    public static function bootBootedTrait(): void
    {
        static::retrieved(function ($model) {
            $model->logEvent($model, 'retrieved :'. get_class($model), null, $model->getAttributes());
        });

        static::created(function ($model) {
            $model->logEvent($model, 'created :'. get_class($model), null, $model->getAttributes());
        });

        static::updated(function ($model) {
            $model->logEvent($model, 'updated :'. get_class($model), $model->getOriginal(), $model->getDirty());
        });

        static::deleted(function ($model) {
            $model->logEvent($model, 'deleted :'. get_class($model), $model->getAttributes(), null);
        });
    }

    protected function logEvent($model, string $eventName, ?array $oldAttributes, ?array $newAttributes): void
    {
//        LoggingStartedEvent::dispatch($this);

        Log::query()->create([
            'model_id' => $model->id,
            'event_name' => $eventName,
            'old_attributes' => json_encode($oldAttributes),
            'new_attributes' => json_encode($newAttributes),
            'changed_at' => now(),
        ]);

//        LoggingFinishedEvent::dispatch($this);
    }
}
