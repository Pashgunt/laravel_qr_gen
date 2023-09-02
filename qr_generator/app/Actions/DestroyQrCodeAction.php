<?php

namespace App\Actions;

use App\Filters\QrLinkFilter;
use App\Models\QrLink;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\QrLinkRepository;

class DestroyQrCodeAction
{
    public function handle(int $id): bool
    {
        $resultOfDeleteLink = app(QrLinkRepository::class)->updateLink(
            QrLink::filter(
                new QrLinkFilter(),
                [
                    'link_id' => $id
                ]
            ),
            ['is_actual' => 0]
        );
        if (!$resultOfDeleteLink) return false;
        $resultOfDeleteHash = app(CompanyTableHashRepository::class)
            ->updateCompanyTableHash(
                QrLink::filter(
                    new QrLinkFilter(),
                    [
                        'link_id' => $id
                    ]
                ),
                ['is_actual' => 0]
            );
        if (!$resultOfDeleteHash) return false;
        return true;
    }
}
