<?php

namespace App\Actions;

use App\Filters\CompanyFilter;
use App\Filters\FeedbackFilterResultFilter;
use App\Filters\PageSettingsFilter;
use App\Models\Company;
use App\Models\FeedbackFilter;
use App\Models\PageSetings;
use Illuminate\Http\Request;

class ResultFeedbackAction
{
    public function hande(
        Request $request,
        FeedbackFilterResultFilter $filter
    ): array {
        $feedback = FeedbackFilter::filter($filter)->first()->getFeedback()->first();
        $company = Company::filter(new CompanyFilter($request), ['company_id' => $feedback->company_id])->first();
        $pageSetting = PageSetings::filter(new PageSettingsFilter($request), [
            'company_id' => $feedback->company_id,
            'is_actual' => 1,
            'page_type' => $request->route('result'),
        ])->first();
        $pageSettingLinks = $pageSetting?->getPageSettingLinks()->get();
        return compact(
            'company',
            'feedback',
            'pageSetting',
            'pageSettingLinks'
        );
    }
}
