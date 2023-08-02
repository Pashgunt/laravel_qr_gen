<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Services\FeedbackService;
use App\QR\Services\Rating;
use Illuminate\Pipeline\Pipeline;

class LocationFeedback extends Controller
{
    public function store(FeedbackRequest $request)
    {
        $feedbackService = new FeedbackService(app(LocationFeedbackRepository::class));
        $feedbackDTO = $request->makeDTO();
        $tableData = app(CompanyTableHashRepository::class)
            ->checkIssetHashString($request->route()->parameter('qr'));
        $companyID  = $tableData->company_id;
        $tabeID  = $tableData->id;
        $filters = $feedbackService->feedbackFilters(1, 1, FunnelEnums::FEEDBACK->value);
        $filterResult = $feedbackService->checkCorrectData($filters, $feedbackDTO);
        if ($filterResult) {
            app(LocationFeedbackRepository::class)->createNewFeedback(
                $companyID,
                $tabeID,
                $feedbackDTO->getRating(),
                $feedbackDTO->getFeedbackText(),
                $feedbackDTO->getName(),
                $feedbackDTO->getContact()
            );
        } else {
            // TODO make logic bad feedback
        }
    }

    public function show(string $qr)
    {
        $company = app(CompanyTableHashRepository::class)
            ->checkIssetHashString($qr);
        $dataForSend = [
            'company' => $company,
            'feedback_list' => app(LocationFeedbackRepository::class)
                ->getPaginationFeedbackList($company->company_id, 5)
        ];
        $data = app(Pipeline::class)
            ->send($dataForSend)
            ->through([
                new Rating(app(LocationFeedbackRepository::class)),
            ])
            ->via('preparePipeline')
            ->thenReturn();
        return view('location.feedback', compact('data'));
    }
}
