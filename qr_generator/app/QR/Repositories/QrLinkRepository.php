<?php

namespace App\QR\Repositories;

use App\Models\QrLink;

class QrLinkRepository
{
    public function createLink(
        string $link,
        int $companyHashId
    ) {
        return QrLink::create([
            'company_hash_id' => $companyHashId,
            'link' => $link
        ]);
    }
}
