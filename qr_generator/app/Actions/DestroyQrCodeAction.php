<?php

namespace App\Actions;

use App\Models\QrLink;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\QrLinkRepository;

class DestroyQrCodeAction
{
    public function handle(int $id): bool
    {
        $resultOfDeleteLink = app(QrLinkRepository::class)->updateLink($id, ['is_actual' => 0]);
        if (!$resultOfDeleteLink) return false;
        $resultOfDeleteHash = app(CompanyTableHashRepository::class)
            ->updateCompanyTableHash(
                QrLink::find($id)->company_hash_id,
                ['is_actual' => 0]
            );
        if (!$resultOfDeleteHash) return false;
        return true;
    }
}
