<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotificationConfig extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'notification_config_params';

    protected $fillable = [
        'company_id',
        'email',
        'is_send_positive',
        'is_send_negative',
    ];

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    public function scopeJoined(Builder $builder){
        return $builder->join('companies', 'notification_config_params.company_id', '=', 'companies.id');
    }

    public function scopeGetParams(Builder $builder){
        return $builder->get([
            'notification_config_params.*',
            'companies.*',
            'notification_config_params.id as notification_id'
        ]);
    }

    public function scopeFilter(
        Builder $builder,
        ?QueryFilter $filter = null,
        array $additionalParams = []
    ) {
        return $filter?->apply($builder, $additionalParams);
    }
}
