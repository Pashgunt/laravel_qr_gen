<?php

namespace App\QR\Repositories;

use App\Models\QrCode;

class QrCodeRepository
{
    public function createQrCode(
        string $fileName,
        string $filePath,
        int $linkID
    ) {
        return QrCode::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'link_id' => $linkID,
        ]);
    }
}
