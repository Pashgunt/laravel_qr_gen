<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'adress',
        'link',
    ];

    protected $table = 'companies';

    public function getCompanyTables()
    {
        return $this->hasMany(CompanyTableHash::class, 'company_id', 'id');
    }
}
