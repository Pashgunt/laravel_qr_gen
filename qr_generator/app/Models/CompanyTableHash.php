<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
