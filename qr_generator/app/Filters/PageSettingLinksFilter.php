<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PageSettingLinksFilter extends QueryFilter
{
    public function link_id(int $linkId): Builder
    {
        return $this->builder->where('id', $linkId);
    }

    public function setting_id(int $settingId): Builder
    {
        return $this->builder->where('page_setting_id', $settingId);
    }
}
