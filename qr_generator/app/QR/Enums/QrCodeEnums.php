<?php

namespace App\QR\Enums;

use App\QR\Abstracts\FunnelEnums;

enum QrCodeEnums: string implements FunnelEnums
{
    case SIZE = '300';
    case IMG_QR_CODE = 'img';
    case PDF_QR_CODE = 'pdf';
    case QR_PREFIX = 'feed.localhost:8888/location';

    public static function getAssociations(): array
    {
        return [];
    }
}
