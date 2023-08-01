<?php

namespace App\QR\Enums;

use App\QR\Abstracts\FunnelEnums as AbstractsFunnelEnums;
use App\Qr\Services\FunnelConfig;
use App\Qr\Services\FunnelField;
use App\Qr\Services\FunnelLogic;
use App\QR\Services\FunnelType;

enum FunnelEnums: string implements AbstractsFunnelEnums
{
    case FEEDBACK = 'feedback';
    case CONFIG = 'config';
    case FIELD = 'field';
    case LOGIC = 'logic';
    case TYPE = 'type';

    public static function getAssociations()
    {
        return function ($type, $repository) {
            return match ($type) {
                self::CONFIG->value => new FunnelConfig($repository),
                self::FIELD->value => new FunnelField($repository),
                self::LOGIC->value => new FunnelLogic($repository),
                self::TYPE->value => new FunnelType($repository),
            };
        };
    }
}
