<?php

namespace App\QR\Enums;

enum FunnelOperatorEnums: string
{
    case EQUAL = '=';
    case NOT_EQUAL = '!=';
    case RANGE = 'between';

    public static function getOperators()
    {
        return array_map(function ($operator) {
            return match ($operator) {
                self::EQUAL->value => self::prepareFeedbackOperators('равно', 'equal', $operator),
                self::NOT_EQUAL->value => self::prepareFeedbackOperators('не равно', 'not_equal', $operator),
                self::RANGE->value => self::prepareFeedbackOperators('в интервале', 'range', $operator),
            };
        }, array_column(self::cases(), 'value'));
    }

    private static function prepareFeedbackOperators(string $name, string $tag, string $operator)
    {
        return [
            'name' => $name,
            'tag' => $tag,
            'operator' => $operator,
        ];
    }
}
