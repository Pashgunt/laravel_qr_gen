<?php

namespace App\QR\Services;

use App\QR\Repositories\QrCodeRepository;
use App\QR\Repositories\QrLinkRepository;
use Closure;
use Illuminate\Support\Facades\Storage;

class SaveQrCodeData
{
    public function saveQrCodePipeline(
        array $data,
        Closure $next
    ): array {
        $linkId = app(QrLinkRepository::class)->createLink(
            $data['link'],
            $data['company_hash_id']
        )->id;
        if ($linkId) {
            $data['link_id'] = $linkId;
            $fileName = "qr_$linkId.svg";
            $filePath = sprintf("%s/%s", uniqid('qr_'), $fileName);
            $resOfCreate = Storage::disk('public')->put($filePath, $data['qr']);
            $data['file_path'] = current(explode("/", $filePath));
            if ($resOfCreate) {
                app(QrCodeRepository::class)->createQrCode($fileName, $filePath, $linkId);
            }
        }
        return $next($data);
    }
}
