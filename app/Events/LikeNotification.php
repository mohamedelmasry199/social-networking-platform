<?php

namespace App\Events;

use App\Models\Like;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LikeNotification implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function broadcastOn()
    {
        return new Channel('likes');
    }
}
