<?php

namespace App\Http\Controllers;

use App\Actions\ShowFeedbackAction;
use App\Filters\CompanyHashFilter;
use App\Filters\FeedbackFilter;
use App\Http\Requests\FeedbackRequest;
use App\Models\CompanyTableHash;
use App\Models\Feedback;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Services\FeedbackService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationFeedbackController extends Controller
{

    public function index(FeedbackFilter $filter): View
    {
        $feedbacks = Feedback::filter($filter)->paginate(10);

        return view('location.feedback-list', compact('feedbacks'));
    }

    public function store(FeedbackRequest $request): void
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
        Request $request,
        ShowFeedbackAction $showFeedback
    ): View {
        $data = $showFeedback->handle($request);
        return view('location.feedback', compact('data'));
    }
}
