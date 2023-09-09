<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailAfterFeedbackNotification extends Notification
{
    use Queueable;

    public Feedback $feedback;
    public array $filterResult;

    public function __construct(
        Feedback $feedback,
        array $filterResult
    ) {
        $this->feedback = $feedback;
        $this->filterResult = $filterResult;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Новый отзыв')
            ->markdown(
                'mail.feedback',
                [
                    'feedback' => $this->feedback,
                    'filterResult' => $this->filterResult
                ]
            );
    }
}
