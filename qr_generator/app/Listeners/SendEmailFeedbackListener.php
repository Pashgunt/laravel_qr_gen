<?php

namespace App\Listeners;

use App\Notifications\SendEmailAfterFeedbackNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailFeedbackListener
{
    public function handle(object $event): void
    {
        if (
            ($event->filterResult && $event->notificationConfig->is_send_positive) ||
            (!$event->filterResult && $event->notificationConfig->is_send_negative)
        )
            $event->notificationConfig->notify(
                new SendEmailAfterFeedbackNotification(
                    $event->feedback,
                    $event->filterResult,
                )
            );
    }
}
