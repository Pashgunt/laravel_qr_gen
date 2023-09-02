<?php

namespace App\Actions;

use App\Events\SendFeedback;
use App\Filters\CompanyHashFilter;
use App\Filters\NotificationConfigFilter;
use App\Http\Requests\FeedbackRequest;
use App\Models\CompanyTableHash;
use App\Models\NotificationConfig;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FeedbackFilterRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Services\FeedbackService;

class StoreFeedbackAction
{
    public function handle(FeedbackRequest $request)
    {
        //TODO make in Pipeline
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

            $notificationConfig = NotificationConfig::filter(
                new NotificationConfigFilter($request),
                ['company_id' => $companyID]
            )->first();

            if ($notificationConfig) event(new SendFeedback($feedback, $notificationConfig, $filterResult));

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
