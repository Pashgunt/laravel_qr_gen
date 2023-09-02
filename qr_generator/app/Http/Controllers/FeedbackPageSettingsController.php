<?php

namespace App\Http\Controllers;

use App\Actions\StorePageSetingAction;
use App\Filters\PageSettingsFilter;
use App\Http\Requests\PageSettingFeedbackRequest;
use App\Models\Company;
use App\QR\Enums\PageTypeSetings;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FeedbackPageSettingsController extends Controller
{
    public function index(): View
    {
        return view('page-settings.page-settings-index');
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
