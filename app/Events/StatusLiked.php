<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StatusLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;

    public $message;

    public $who_send;

    public $title;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username, $who, $title)
    {
        $this->username = $username;
        $this->message  = "{$username}님이";
        $this->who_send = $who."님";
        $this->title = $title;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['status-liked'];
    }
}