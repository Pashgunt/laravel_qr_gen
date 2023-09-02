<?php

namespace App\Listeners;

use App\Events\RegisteredUser;
use App\Notifications\RegisterUserNotification;

class SendEmailVerigicationRegistration
{
    public function handle(RegisteredUser $event): void
    {
        $event->user->notify(new RegisterUserNotification(
            $event->user,
            $event->subdomain
        ));
    }
}
