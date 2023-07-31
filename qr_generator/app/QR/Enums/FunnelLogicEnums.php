<?php

namespace App\QR\Enums;

use App\QR\Abstracts\FunnelInterface;

enum FunnelLogicEnums: string implements FunnelInterface
{
    case AND = 'AND';
    case OR = 'OR';

    public static function getOperators()
    {
        return array_map(function ($operator) {
            return match ($operator) {
                self::AND->value => self::prepareFunnelOperators('И', $operator),
                self::OR->value => self::prepareFunnelOperators('ИЛИ', $operator),
            };
        }, array_column(self::cases(), 'value'));
    }

    private static function prepareFunnelOperators(string $name, string $operator)
    {
        return [
            'name' => $name,
            'operator' => $operator,
        ];
    }
}
