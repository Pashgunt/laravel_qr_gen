<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_type_tag',
        'funnel_type_name',
    ];

    protected $table = 'funnel_types';

    protected $hidden = [
        'created_at',
        'updated_at',
        'is_actual',
    ];
}
