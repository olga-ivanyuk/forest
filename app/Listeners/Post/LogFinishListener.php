<?php

namespace App\Listeners\Post;

use App\Events\Post\LoggingFinishedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFinishListener
{
    public function __construct()
    {
        //
    }

    public function handle(LoggingFinishedEvent $event): void
    {
        //
    }
}
