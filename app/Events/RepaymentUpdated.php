<?php

namespace App\Events;

use App\Models\loantransaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RepaymentUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $loan_transaction;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(loantransaction $loan_transaction)
    {
        $this->loan_transaction=$loan_transaction;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
