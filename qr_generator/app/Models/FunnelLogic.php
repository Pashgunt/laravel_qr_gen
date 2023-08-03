<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelLogic extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_field_id',
        'logic_operator',
    ];

    protected $table = 'funnel_logic_blocks';
}
