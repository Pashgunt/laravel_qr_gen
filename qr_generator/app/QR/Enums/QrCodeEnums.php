<?php

namespace App\QR\Enums;

enum QrCodeEnums: string
{
    case SIZE = '300';
    case IMG_QR_CODE = 'img';
    case PDF_QR_CODE = 'pdf';
    case QR_PREFIX = 'localhost:8888/location';
}
