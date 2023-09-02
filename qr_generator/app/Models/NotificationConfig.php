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
    ];

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    public function scopeFilter(
        Builder $builder,
        ?QueryFilter $filter = null,
        array $additionalParams
    ) {
        return $filter?->apply($builder, $additionalParams);
    }
}
