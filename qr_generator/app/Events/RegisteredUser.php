<?php

namespace App\Events;

use App\Models\SubdomainAuth;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisteredUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public SubdomainAuth $subdomain;

    public function __construct(
        User $user,
        SubdomainAuth $subdomain
    ) {
        $this->user = $user;
        $this->subdomain = $subdomain;
    }
}
