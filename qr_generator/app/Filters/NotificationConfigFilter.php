<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class NotificationConfigFilter extends QueryFilter
{
    public function notification_config(int $notification_config): Builder
    {
        return $this->builder->where('notification_config_params.id', $notification_config);
    }

    public function company_id(int $company_id): Builder
    {
        return $this->builder->where('notification_config_params.company_id', $company_id);
    }
}
