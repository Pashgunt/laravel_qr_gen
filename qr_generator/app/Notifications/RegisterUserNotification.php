<?php

namespace App\Notifications;

use App\Models\SubdomainAuth;
use App\Models\User;
use App\Qr\Helpers\Subdomain;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private User $user;
    private SubdomainAuth $subdomain;

    public function __construct(User $user, SubdomainAuth $subdomain)
    {
        $this->user = $user;
        $this->subdomain = $subdomain;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->view(
                'mail.register',
                [
                    'link' => Subdomain::generateRedirectUrl(
                        $this->subdomain->subdomain,
                        sprintf('email/verify/%s/%s', $this->user->id, sha1($this->user->email))
                    ),
                ]
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
