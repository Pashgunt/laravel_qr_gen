<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackFilter extends Model
{
    use HasFactory;

    protected $table = 'feedback_filter_results';

    protected $fillable = [
        'feedback_id',
        'filter_result',
        'filter_result_descripton',
        'hash'
    ];

    public function scopeFilter(
        Builder $builder,
        ?QueryFilter $filter = null,
        array $additionalParams = []
    ) {
        return $filter?->apply(
            $builder,
            $additionalParams
        );
    }

    public function getFeedback()
    {
        return $this->hasOne(Feedback::class, 'id', 'feedback_id');
    }
}
