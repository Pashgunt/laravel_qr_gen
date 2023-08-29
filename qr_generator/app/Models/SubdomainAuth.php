<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubdomainAuth extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'subdomain',
        'email',
        'user_id',
    ];

    protected $table = 'subdomain_user_authorized';

    public function getUser()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
