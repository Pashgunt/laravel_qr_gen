<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;

class QrCodeRepository extends Repositories
{
    public function createQrCode(
        string $fileName,
        string $filePath,
        int $linkID
    ) {
        return $this->create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'link_id' => $linkID,
        ]);
    }
}
