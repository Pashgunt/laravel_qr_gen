<?php

namespace App\QR\Enums;

use App\QR\Abstracts\FunnelEnums;

enum FunnelLogicEnums: string implements FunnelEnums
{
    case AND = 'AND';
    case OR = 'OR';

    public static function getAssociations(): array
    {
        return array_map(function ($operator) {
            return match ($operator) {
                self::AND->value => self::prepareFunnelOperators('И', $operator),
                self::OR->value => self::prepareFunnelOperators('ИЛИ', $operator),
            };
        }, array_column(self::cases(), 'value'));
    }

    private static function prepareFunnelOperators(
        string $name,
        string $operator
    ): array {
        return [
            'name' => $name,
            'operator' => $operator,
        ];
    }
}
