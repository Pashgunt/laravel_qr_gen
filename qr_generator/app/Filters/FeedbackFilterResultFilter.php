<?php

namespace App\Filters;

use App\QR\Enums\PageTypeSetings;
use Illuminate\Database\Eloquent\Builder;

class FeedbackFilterResultFilter extends QueryFilter
{
    public function hash_empty(string $hash): Builder
    {
        return $this->builder->where('hash', '!=', $hash);
    }

    public function hash(string $hash): Builder
    {
        return $this->builder->where('hash', $hash);
    }

    public function result(string $result): Builder
    {
        $result = $result === PageTypeSetings::POSITIVE->value ? 1 : 0;
        return $this->builder->where('filter_result', $result);
    }

    public function created_at_least(string $date): Builder
    {
        return $this->builder->where('created_at', '<', $date);
    }
}
