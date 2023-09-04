<?php

namespace App\Http\Controllers;

use App\Actions\StorePageSetingAction;
use App\Filters\PageSettingLinksFilter;
use App\Filters\PageSettingsFilter;
use App\Http\Requests\PageSettingFeedbackRequest;
use App\Http\Requests\PageSettingLinkRequest;
use App\Models\Company;
use App\Models\PageSetings;
use App\Models\PageSettingLinks;
use App\QR\Enums\PageTypeSetings;
use App\Qr\Repositories\PageSettingLinksRepository;
use App\Qr\Repositories\PageSettingRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FeedbackPageSettingsController extends Controller
{
    public function index(Request $request): View
    {
        $settings = PageSetings::joined()
            ->filter(new PageSettingsFilter())
            ->getParams();
        return view('page-settings.page-settings-index', compact('settings'));
    }

    public function create(): View
    {
        $companies = Company::filter()->get();
        $pageTypes = PageTypeSetings::getAssociations();
        return view('page-settings.page-settings-create', compact('companies', 'pageTypes'));
    }

    public function store(
        PageSettingFeedbackRequest $request,
        StorePageSetingAction $storePageSetting,
        PageSettingsFilter $pageSettingFilter
    ) {
        $result = $storePageSetting->handle(
            $request,
            $pageSettingFilter
        );
        return $this->prepareResultForUpdate(
            $result,
            'Succes Create',
            'Error Creare',
            'page-settings.index'
        );
    }

    public function edit(PageSettingsFilter $filter)
    {
        $setting = PageSetings::filter($filter)
            ->first();
        $companies = Company::filter()->get();
        $pageTypes = PageTypeSetings::getAssociations();
        return view('page-settings.page-setting-update', compact('setting', 'companies', 'pageTypes'));
    }

    //TODO make in action
    public function update(
        PageSettingFeedbackRequest $request,
        int $id
    ) {
        $settingDTO = $request->makeDTO();
        $result = app(PageSettingRepository::class)
            ->updatePageSetting(
                PageSetings::filter(new PageSettingsFilter(), ['page_setting' => $id]),
                [
                    'title' => $settingDTO->getTitle(),
                    'text' => $settingDTO->getText(),
                    'show_company_info' => $settingDTO->getShowCompanyContact(),
                    'page_type' => $settingDTO->getPageType(),
                    'company_id' => $settingDTO->getCompanyId(),
                ]
            );
        $result = app(PageSettingLinksRepository::class)
            ->updatePageSettingLink(
                PageSettingLinks::filter(new PageSettingLinksFilter(), ['setting_id' => $id]),
                ['is_actual' => 0]
            );
        if ($settingDTO->getPageType() === PageTypeSetings::POSITIVE->value && $settingDTO->getPreapreMapData()) {
            foreach ($settingDTO->getPreapreMapData() as $linkTitle => $link) {
                app(PageSettingLinksRepository::class)->createPageSettingLink(
                    $link,
                    $linkTitle,
                    $id
                );
            }
        }
        return $this->prepareResultForUpdate(
            $result,
            'Succes edit setting',
            'Error edit setting',
            'page-settings.index'
        );
    }

    public function editPageSettingLink(PageSettingLinksFilter $filter)
    {
        $link = PageSettingLinks::filter($filter)->first();
        return view('page-settings.page-setting-update-link', compact('link'));
    }

    public function updatePageSettingLink(PageSettingLinkRequest $request, string $linkID)
    {
        $validated = $request->validated();
        $result = app(PageSettingLinksRepository::class)
            ->updatePageSettingLink(
                PageSettingLinks::filter(new PageSettingLinksFilter(), ['link_id' => $linkID]),
                [
                    'link' => $validated['map_link'],
                    'link_title' => $validated['map_name'],
                ]
            );
        return $this->prepareResultForUpdate(
            $result,
            'Succes edit link',
            'Error edit link',
            'page-settings.index'
        );
    }

    public function destroyPageSettingLink(PageSettingLinksFilter $filter)
    {
        $result = app(PageSettingLinksRepository::class)
            ->updatePageSettingLink(
                PageSettingLinks::filter($filter),
                ['is_actual' => 0]
            );
        return $this->prepareResultForUpdate(
            $result,
            'Succes delete',
            'Error delete',
            'page-settings.index'
        );
    }

    public function destroy(PageSettingsFilter $filter)
    {
        $result = app(PageSettingRepository::class)
            ->updatePageSetting(
                PageSetings::filter($filter),
                ['is_actual' => 0]
            );
        return $this->prepareResultForUpdate(
            $result,
            'Succes delete',
            'Error delete',
            'page-settings.index'
        );
    }
}
