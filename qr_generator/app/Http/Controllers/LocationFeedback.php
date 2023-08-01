<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\CompanyTableHashRepository;
use App\Qr\Repositories\FunnelConfigRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Services\FeedbackService;
use App\QR\Services\Rating;
use Illuminate\Pipeline\Pipeline;

class LocationFeedback extends Controller
{
    public function store(FeedbackRequest $request)
    {
        $feedbackDTO = $request->makeDTO();
        $tableData = app(CompanyTableHashRepository::class)
            ->checkIssetHashString($request->route()->parameter('qr'));
        $companyID  = $tableData->company_id;
        $filters = (new FeedbackService(app(LocationFeedbackRepository::class)))
            ->feedbackFilters(1, 1, FunnelEnums::FEEDBACK->value);
        $tabeID  = $tableData->id;
        $result = app(LocationFeedbackRepository::class)->createNewFeedback(
            $companyID,
            $tabeID,
            $feedbackDTO->getRating(),
            $feedbackDTO->getFeedbackText(),
            $feedbackDTO->getName(),
            $feedbackDTO->getContact()
        );
        if ($result) {
            return view('components.feedback-success');
        }
        dd($result);
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
