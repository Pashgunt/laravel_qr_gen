<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'table_id',
        'rating',
        'feedback_text',
        'feedback_user_name',
        'contact_data',
    ];

    protected $table = 'feedback';
}
