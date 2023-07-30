<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\QR\Contracts\Feedback;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Services\FeedbackList;
use App\QR\Services\Rating;
use Illuminate\Pipeline\Pipeline;

class LocationFeedback extends Controller
{

    private CompanyTableHashRepository $companyTabeHashRepository;
    private LocationFeedbackRepository $locationFeedbackRepository;

    public function __construct(
        CompanyTableHashRepository $companyTabeHashRepository,
        LocationFeedbackRepository $locationFeedbackRepository
    ) {
        $this->companyTabeHashRepository = $companyTabeHashRepository;
        $this->locationFeedbackRepository = $locationFeedbackRepository;
    }

    public function store(FeedbackRequest $request)
    {
        $feedbackDTO = $request->makeDTO();
        $tableData = $this->companyTabeHashRepository->checkIssetHashString($request->route()->parameter('qr'));
        $companyID  = $tableData->company_id;
        $tabeID  = $tableData->id;
        $result = $this->locationFeedbackRepository->createNewFeedback(
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

    public function show(string $qr, Feedback $feedback)
    {
        $data = app(Pipeline::class)
            ->send($this->companyTabeHashRepository
                ->checkIssetHashString($qr))
            ->through([
                $feedback,
                new Rating($this->locationFeedbackRepository),
                new FeedbackList($this->locationFeedbackRepository)
            ])
            ->via('preparePipeline')
            ->thenReturn();
        return view('location.feedback', compact('data'));
    }
}
