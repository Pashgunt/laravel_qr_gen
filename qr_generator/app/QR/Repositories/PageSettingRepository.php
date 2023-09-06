<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;

class PageSettingRepository extends Repositories
{
    public function createPageSetting(
        string $title,
        string $text,
        string $pageType,
        int $showCompanyInfo,
        int $companyID
    ) {
        return $this->create([
            'title' => $title,
            'text' => $text,
            'show_company_info' => $showCompanyInfo,
            'page_type' => $pageType,
            'company_id' => $companyID,
        ]);
    }

    public function updatePageSetting($raw, array $update)
    {
        return $this->update($raw, $update);
    }
}
