<?php

namespace App\Events;

use App\Models\Feedback;
use App\Models\NotificationConfig;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendFeedback
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Feedback $feedback;
    public array $filterResult;
    public NotificationConfig $notificationConfig;

    public function __construct(
        Feedback $feedback,
        NotificationConfig $notificationConfig,
        array $filterResult
    ) {
        $this->feedback = $feedback;
        $this->notificationConfig = $notificationConfig;
        $this->filterResult = $filterResult;
    }
}
