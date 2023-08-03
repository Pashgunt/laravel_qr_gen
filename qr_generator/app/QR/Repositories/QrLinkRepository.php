<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;

class QrLinkRepository extends Repositories
{
    public function createLink(
        string $link,
        int $companyHashId
    ) {
        return $this->create([
            'company_hash_id' => $companyHashId,
            'link' => $link
        ]);
    }

    public function updateLink(int $linkID, array $update)
    {
        return $this->update($this->model->where('id', $linkID), $update);
    }
}
