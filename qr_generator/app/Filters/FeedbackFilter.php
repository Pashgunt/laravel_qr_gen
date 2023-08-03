<?php

namespace App\Filters;

class FeedbackFilter extends QueryFilter
{
    public function company_id($id)
    {
        return $this->builder->where('company_id', $id);
    }
}
