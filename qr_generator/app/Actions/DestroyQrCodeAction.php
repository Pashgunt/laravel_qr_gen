<?php

namespace App\Actions;

use App\Filters\QrLinkFilter;
use App\Models\QrLink;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\QrLinkRepository;

class DestroyQrCodeAction
{
    public function handle(QrLinkFilter $filter): bool
    {
        $resultOfDeleteLink = app(QrLinkRepository::class)->updateLink(
            QrLink::filter($filter),
            ['is_actual' => 0]
        );
        if (!$resultOfDeleteLink) return false;
        $resultOfDeleteHash = app(CompanyTableHashRepository::class)
            ->updateCompanyTableHash(
                QrLink::filter($filter),
                ['is_actual' => 0]
            );
        if (!$resultOfDeleteHash) return false;
        return true;
    }
}
