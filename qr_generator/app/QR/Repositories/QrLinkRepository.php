<?php

namespace App\QR\Repositories;

use App\Models\QrLink;

class QrLinkRepository
{
    public function createLink(string $link)
    {
        return QrLink::create([
            'link' => $link
        ]);
    }
}
