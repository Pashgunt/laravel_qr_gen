<?php

namespace App\Actions;

use App\Filters\PageSettingsFilter;
use App\Http\Requests\PageSettingFeedbackRequest;
use App\Models\PageSetings;
use App\QR\Repositories\PageSettingLinksRepository;
use App\QR\Repositories\PageSettingRepository;

class StorePageSetingAction
{
    public function handle(
        PageSettingFeedbackRequest $request,
        PageSettingsFilter $pageSettingFilter
    ): bool {
        $pageSettingDTO = $request->makeDTO();
        app(PageSettingRepository::class)->updatePageSetting(
            PageSetings::filter($pageSettingFilter, ['is_actual' => 1]),
            [
                'is_actual' => 0,
            ]
        );
        $pageSetting = app(PageSettingRepository::class)->createPageSetting(
            $pageSettingDTO->getTitle(),
            $pageSettingDTO->getText(),
            $pageSettingDTO->getPageType(),
            $pageSettingDTO->getShowCompanyContact(),
            $pageSettingDTO->getCompanyId()
        );
        if ($pageSetting && $pageSettingDTO->getPreapreMapData()) {
            foreach ($pageSettingDTO->getPreapreMapData() as $linkTitle => $link) {
                app(PageSettingLinksRepository::class)->createPageSettingLink(
                    $link,
                    $linkTitle,
                    $pageSetting->id
                );
            }
        }
        return true;
    }
}
