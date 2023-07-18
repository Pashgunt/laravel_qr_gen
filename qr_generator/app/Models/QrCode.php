<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'file_name',
        'file_path',
        'link_id',
    ];

    protected $table = 'qr_codes';
}
