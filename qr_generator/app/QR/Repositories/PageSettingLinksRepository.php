<?php

namespace App\Qr\Repositories;

use App\QR\Abstracts\Repositories;

class PageSettingLinksRepository extends Repositories
{
    public function createPageSettingLink(
        string $link,
        string $linkTitle,
        int $pageSettingId
    ) {
        return $this->create([
            'link' => $link,
            'link_title' => $linkTitle,
            'page_setting_id' => $pageSettingId,
        ]);
    }

    public function updatePageSettingLink($raw, array $update)
    {
        return $this->update($raw, $update);
    }
}
