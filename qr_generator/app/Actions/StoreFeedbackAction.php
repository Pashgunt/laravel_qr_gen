<?php

namespace App\Actions;

use App\Filters\CompanyHashFilter;
use App\Http\Requests\FeedbackRequest;
use App\Models\CompanyTableHash;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FeedbackFilterRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Services\FeedbackService;

class StoreFeedbackAction
{
    public function handle(FeedbackRequest $request)
    {
        $feedbackService = new FeedbackService(app(LocationFeedbackRepository::class));
        $feedbackDTO = $request->makeDTO();
        $tableData = CompanyTableHash::filter(new CompanyHashFilter($request))->first();
        if ($tableData) {
            [$companyID, $tabeID]  = [$tableData->company_id, $tableData->id];
            $filters = $feedbackService->feedbackFilters($companyID, 1, FunnelEnums::FEEDBACK->value);
            $filterResult = $feedbackService->checkCorrectData($filters, $feedbackDTO);
            $feedback = app(LocationFeedbackRepository::class)->createNewFeedback(
                $companyID,
                $tabeID,
                $feedbackDTO->getRating(),
                $feedbackDTO->getFeedbackText(),
                $feedbackDTO->getName(),
                $feedbackDTO->getContact()
            );
            $hash = sha1($feedback->id);
            app(FeedbackFilterRepository::class)
                ->createFeedbackFilterResult(
                    $feedback->id,
                    $filterResult['result'],
                    $filterResult['description'],
                    $hash
                );

            $filterResult['result'] ? 1 : 0;

            return [
                'result' => $filterResult['result'],
                'hash' => $hash,
            ];
        }

        return [
            'result' => false
        ];
    }
}
