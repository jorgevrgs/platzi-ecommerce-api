<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ModelRated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Model */
    protected $qualifier;

    /** @var Model */
    protected $rateable;

    protected $score;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $qualifier, Model $rateable, float $score)
    {
        //
        $this->qualifier = $qualifier;
        $this->rateable = $rateable;
        $this->score = $score;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * Get the value of qualifier
     */
    public function getQualifier()
    {
        return $this->qualifier;
    }

    /**
     * Get the value of rateable
     */
    public function getRateable()
    {
        return $this->rateable;
    }

    /**
     * Get the value of score
     */
    public function getScore()
    {
        return $this->score;
    }
}
