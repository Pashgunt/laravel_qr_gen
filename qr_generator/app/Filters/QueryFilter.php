<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;
    
    protected array $addedParams;
    
    protected $builder;
    
    protected string $delimiter = ',';
    
    //TODO make add additionalParams and check is work
    public function __construct(?Request $request, array $addedFilterParams = [])
    {
        $this->request = $request ?? [];
        $this->addedParams = $addedFilterParams;
    }
    public function apply(Builder $builder): void
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            if (method_exists($this, $field)) {
                call_user_func_array([$this, $field], [$value]);
            }
        }
    }

    protected function fields(): array
    {
        return array_filter(
            array_map(function ($item) {
                if (!is_array($item)) return trim($item);
                return $item;
            }, array_merge(
                $this->request ? $this->request?->route()?->parameters() : [],
                $this->request ? $this->request?->all() : [],
                $this->addedParams
            ))
        );
    }

    protected function paramToArray(string $param): array
    {
        return explode($this->delimiter, $param);
    }
}
