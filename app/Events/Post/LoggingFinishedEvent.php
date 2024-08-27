<?php

namespace App\Events\Post;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoggingFinishedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Post $post)
    {
        //
    }
}
