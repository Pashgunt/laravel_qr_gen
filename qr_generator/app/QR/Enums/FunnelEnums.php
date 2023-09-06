<?php

namespace App\QR\Enums;

use App\QR\Abstracts\FunnelEnums as AbstractsFunnelEnums;
use App\QR\Services\FunnelConfigService;
use App\QR\Services\FunnelFieldService;
use App\QR\Services\FunnelLogicService;
use App\QR\Services\FunnelTypeService;

enum FunnelEnums: string implements AbstractsFunnelEnums
{
    case FEEDBACK = 'feedback';
    case CONFIG = 'config';
    case FIELD = 'field';
    case LOGIC = 'logic';
    case TYPE = 'type';

    /**
     * @return FunnelConfigService|FunnelFieldService|FunnelLogicService|FunnelTypeService
     */
    public static function getAssociations()
    {
        return function ($type, $repository) {
            return match ($type) {
                self::CONFIG->value => new FunnelConfigService($repository),
                self::FIELD->value => new FunnelFieldService($repository),
                self::LOGIC->value => new FunnelLogicService($repository),
                self::TYPE->value => new FunnelTypeService($repository),
                default => '',
            };
        };
    }
}
