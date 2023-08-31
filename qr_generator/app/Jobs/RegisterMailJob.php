<?php

namespace App\Jobs;

use App\Models\SubdomainAuth;
use App\Models\User;
use App\Notifications\RegisterUserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegisterMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;
    private SubdomainAuth $subdomain;

    public function __construct(User $user, SubdomainAuth $subdomain)
    {
        $this->user = $user;
        $this->subdomain = $subdomain;
    }

    public function handle(): void
    {
        $this->user->notify(new RegisterUserNotification(
            $this->user,
            $this->subdomain
        ));
    }
}
