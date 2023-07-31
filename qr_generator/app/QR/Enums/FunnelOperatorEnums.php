<?php

namespace App\QR\Enums;

use App\QR\Abstracts\FunnelInterface;

enum FunnelOperatorEnums: string implements FunnelInterface
{
    case EQUAL = '=';
    case NOT_EQUAL = '!=';
    case RANGE = 'between';

    public static function getOperators()
    {
        return array_map(function ($operator) {
            return match ($operator) {
                self::EQUAL->value => self::prepareFunnelOperators('равно', 'equal', $operator),
                self::NOT_EQUAL->value => self::prepareFunnelOperators('не равно', 'not_equal', $operator),
                self::RANGE->value => self::prepareFunnelOperators('в интервале', 'range', $operator),
            };
        }, array_column(self::cases(), 'value'));
    }

    private static function prepareFunnelOperators(string $name, string $tag, string $operator)
    {
        return [
            'name' => $name,
            'tag' => $tag,
            'operator' => $operator,
        ];
    }
}
