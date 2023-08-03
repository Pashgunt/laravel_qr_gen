<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelFields extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_config_id',
        'field_name',
        'operator',
        'value',
        'value_range_from',
        'value_range_to',
    ];

    protected $table = 'funnel_fields';
}
