<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportGenerated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $fileName;

    public function __construct($userId, $fileName)
    {
        $this->userId = $userId;
        $this->fileName = $fileName;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('reports')
        ];
    }

    public function broadcastAs(): string
    {
        return 'report.generated';
    }
}
