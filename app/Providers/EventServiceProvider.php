<?php

namespace App\Providers;

use App\Events\Post\LoggingStartedEvent;
use App\Listeners\Post\LogStartListener;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen(
            LoggingStartedEvent::class,
            LogStartListener::class,
        );
    }
}
