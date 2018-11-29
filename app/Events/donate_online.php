<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class donate_online implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $all_point;

   
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->all_point = $all_point = \Illuminate\Support\Facades\DB::table('donations')->sum('point');;

        // $this->message  = "{$username}님이";
        // $this->who_send = $who."님";
        // $this->title = $title;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['donate-online'];
    }
}