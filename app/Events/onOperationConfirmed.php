<?php

namespace App\Events;

use App\Bid;
use App\Services\Operations\Calculator;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class onOperationConfirmed {
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $bid;

  public $calculator;

  public function __construct(Bid $bid, Calculator $calculator) {

    $this->bid = $bid;
    $this->calculator = $calculator;
  }


  public function broadcastOn() {
    return new PrivateChannel('channel-name');
  }
}
