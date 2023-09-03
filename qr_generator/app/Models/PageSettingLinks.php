<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSettingLinks extends Model
{
    use HasFactory;

    protected $table = 'page_setting_links';

    protected $fillable = [
        'link',
        'link_title',
        'page_setting_id',
    ];

    public function scopeFilter(
        Builder $builder,
        ?QueryFilter $filter = NULL,
        array $additionaParams = []
    ) {
        return $filter?->apply($builder, $additionaParams);
    }
}
