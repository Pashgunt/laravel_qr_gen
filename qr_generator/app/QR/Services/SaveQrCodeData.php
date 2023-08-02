<?php

namespace App\QR\Services;

use App\QR\Repositories\QrCodeRepository;
use App\QR\Repositories\QrLinkRepository;
use Closure;
use Illuminate\Support\Facades\Storage;

class SaveQrCodeData
{
    public function pipelineHandler(array $qrData, Closure $next)
    {
        $linkId = app(QrLinkRepository::class)->createLink(
            $qrData['link'],
            $qrData['company_hash_id']
        )->id;
        if ($linkId) {
            $qrData['link_id'] = $linkId;
            $fileName = "qr_$linkId.svg";
            $filePath = sprintf("%s/%s", uniqid('qr_'), $fileName);
            $resOfCreate = Storage::disk('public')->put($filePath, $qrData['qr']);
            $qrData['file_path'] = current(explode("/", $filePath));
            if ($resOfCreate) {
                app(QrCodeRepository::class)->createQrCode($fileName, $filePath, $linkId);
            }
        }
        return $next($qrData);
    }
}
