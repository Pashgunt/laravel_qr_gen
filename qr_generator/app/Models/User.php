<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Qr\Helpers\Subdomain;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        Auth::guard('subdomain')->validateEmail([
            'email' => $this->email
        ]);
        $subdomain = Auth::guard('subdomain')->subdomain();
        $url = Subdomain::generateRedirectUrl(
            $subdomain->subdomain,
            sprintf('%s?email=%s', $token, $this->email)
        );
        return $this->notify(new ResetPasswordNotification($url));
    }
}
