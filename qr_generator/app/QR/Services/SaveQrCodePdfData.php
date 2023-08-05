<?php

namespace App\QR\Services;

use App\QR\Repositories\QrPdfRepository;
use Closure;
use Illuminate\Support\Facades\Storage;
use PDF;

class SaveQrCodePdfData
{
    public function saveQrCodePipeline(
        array $data,
        Closure $next
    ): array {
        $linkId = $data['link_id'];
        $fileName = "qr_$linkId.pdf";
        $filePath = sprintf("%s/%s", $data['file_path'], $fileName);
        $resOfCreate = Storage::disk('public')
            ->put(
                $filePath,
                PDF::loadView('qr.qr', ['qr_code' => $data['qr']])
                    ->download()
            );
        if ($resOfCreate) {
            app(QrPdfRepository::class)
                ->createQrCodePdf($fileName, $filePath, $linkId);
        }
        return $next($data);
    }
}
