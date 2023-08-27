<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Model;

class QrLinkRepository extends Repositories
{
    public function createLink(
        string $link,
        int $companyHashId
    ): Model {
        return $this->create([
            'company_hash_id' => $companyHashId,
            'link' => $link
        ]);
    }

    public function updateLink(
        $raw,
        array $update
    ): bool {
        return $this->update($raw, $update);
    }
}
