<?php

namespace App\QR\Enums;

use App\QR\Abstracts\FunnelEnums;

enum PageTypeSetings: string implements FunnelEnums
{
    case POSITIVE = 'POSITIVE';
    case NEGATIVE = 'NEGATIVE';

    public static function getAssociations(): array|object
    {
        return array_map(function ($type) {
            return match ($type) {
                self::POSITIVE->value => self::preparePageTypeOptions('Страница положительного отзыва', $type),
                self::NEGATIVE->value => self::preparePageTypeOptions('Страница негативного отзыва', $type),
                default => '',
            };
        }, array_column(self::cases(), 'value'));
    }

    private static function preparePageTypeOptions(
        string $name,
        string $tag
    ): array {
        return [
            'name' => $name,
            'tag' => $tag,
        ];
    }
}
