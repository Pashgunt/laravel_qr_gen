<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTableHash extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'table_number',
        'hash_value',
    ];

    protected $table = 'company_table_hash';

    public function getCompanyParams(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
