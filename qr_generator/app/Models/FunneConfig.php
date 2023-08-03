<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunneConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'funnel_type_id',
        'work_started_at',
    ];

    protected $table = 'funnel_configs';

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
