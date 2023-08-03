<?php

namespace App\Http\Controllers;

use App\Filters\CompanyHashFilter;
use App\Filters\FeedbackFilter;
use App\Http\Requests\FeedbackRequest;
use App\Models\CompanyTableHash;
use App\Models\Feedback;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Services\FeedbackService;
use App\QR\Services\Rating;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class LocationFeedback extends Controller
{

    public function index(FeedbackFilter $filter)
    {
        $feedbacks = Feedback::filter($filter)->paginate(10);

        return view('location.feedback-list', compact('feedbacks'));
    }

    public function store(FeedbackRequest $request)
    {
        $feedbackService = new FeedbackService(app(LocationFeedbackRepository::class));
        $feedbackDTO = $request->makeDTO();
        $tableData = CompanyTableHash::filter(new CompanyHashFilter($request))->first();;
        $companyID  = $tableData->company_id;
        $tabeID  = $tableData->id;
        $filters = $feedbackService->feedbackFilters($companyID, 1, FunnelEnums::FEEDBACK->value);
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

    public function show(
        CompanyHashFilter $filter,
        FeedbackFilter $feedbackFilter
    ) {
        $company = CompanyTableHash::filter($filter)->first();
        $dataForSend = [
            'company' => $company,
            //TODO make feedback list only for company by id
            'feedback_list' => Feedback::filter($filter)->paginate(10)
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
