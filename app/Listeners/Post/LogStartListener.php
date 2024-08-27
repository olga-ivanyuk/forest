<?php

namespace App\Listeners\Post;

use App\Events\Post\LoggingStartedEvent;
use App\Models\Post;

class LogStartListener
{
    public function __construct(public Post $post)
    {
    }

    public function handle(LoggingStartedEvent $event): void
    {
        dd(11);
    }
}
