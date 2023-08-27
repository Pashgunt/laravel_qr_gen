<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;

    protected $builder;

    protected string $delimiter = ',';

    public function __construct(?Request $request)
    {
        $this->request = $request ?? [];
    }

    public function apply(
        Builder $builder,
        array $additionalParams = []
    ): void {
        $this->builder = $builder;

        foreach ($this->fields($additionalParams) as $field => $value) {
            if (method_exists($this, $field)) {
                call_user_func_array([$this, $field], [$value]);
            }
        }
    }

    protected function fields(array $additionalParams = []): array
    {
        return array_filter(
            array_map(function ($item) {
                if (!is_array($item)) return trim($item);
                return $item;
            }, array_merge(
                $this->request ? $this->request?->route()?->parameters() : [],
                $this->request ? $this->request?->all() : [],
                $additionalParams
            ))
        );
    }

    protected function paramToArray(string $param): array
    {
        return explode($this->delimiter, $param);
    }
}
