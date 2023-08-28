<?php

namespace App\QR\Enums;

use App\QR\Abstracts\FunnelEnums;

enum FunnelOperatorEnums: string implements FunnelEnums
{
    case EQUAL = '=';
    case NOT_EQUAL = '!=';
    case RANGE = 'between';

    public static function getAssociations(): array
    {
        return array_map(function ($operator) {
            return match ($operator) {
                self::EQUAL->value => self::prepareFunnelOperators('равно', 'equal', $operator),
                self::NOT_EQUAL->value => self::prepareFunnelOperators('не равно', 'not_equal', $operator),
                self::RANGE->value => self::prepareFunnelOperators('в интервале', 'range', $operator),
                default => '',
            };
        }, array_column(self::cases(), 'value'));
    }

    private static function prepareFunnelOperators(
        string $name,
        string $tag,
        string $operator
    ): array {
        return [
            'name' => $name,
            'tag' => $tag,
            'operator' => $operator,
        ];
    }
}
