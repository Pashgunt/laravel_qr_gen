<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Model;

class QrPdfRepository extends Repositories
{
    public function createQrCodePdf(
        string $fileName,
        string $filePath,
        int $linkID
    ): Model {
        return $this->create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'link_id' => $linkID,
        ]);
    }
}
