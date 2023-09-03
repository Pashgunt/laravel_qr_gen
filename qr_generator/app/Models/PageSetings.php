<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSetings extends Model
{
    use HasFactory;

    protected $table = 'feedback_page_settings';

    protected $fillable = [
        'title',
        'text',
        'show_company_info',
        'page_type',
        'company_id'
    ];

    public function getPageSettingLinks()
    {
        return $this->hasMany(PageSettingLinks::class, 'page_setting_id', 'id');
    }

    public function scopeJoined(Builder $builder)
    {
        return $builder->join('companies', 'feedback_page_settings.company_id', '=', 'companies.id');
    }

    public function scopeGetParams(Builder $builder)
    {
        return $builder->get([
            'feedback_page_settings.*',
            'companies.*',
            'feedback_page_settings.id as id'
        ]);
    }

    public function scopeFilter(
        Builder $builder,
        ?QueryFilter $filter = NULL,
        array $additionaParams = []
    ) {
        return $filter?->apply($builder, $additionaParams);
    }
}
