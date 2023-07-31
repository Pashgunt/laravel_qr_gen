<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunneConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_type_id',
        'work_started_at',
    ];

    protected $table = 'funnel_configs';
}
