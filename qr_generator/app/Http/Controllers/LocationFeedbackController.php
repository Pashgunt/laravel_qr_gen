<?php

namespace App\Http\Controllers;

use App\Actions\ResultFeedbackAction;
use App\Actions\ShowFeedbackAction;
use App\Actions\StoreFeedbackAction;
use App\Filters\FeedbackFilter;
use App\Filters\FeedbackFilterResultFilter;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Providers\RouteServiceProvider;
use App\QR\Enums\PageTypeSetings;
use App\QR\Repositories\LocationFeedbackRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class LocationFeedbackController extends Controller
{

    public function index(FeedbackFilter $filter): View
    {
        $feedbacks = Feedback::filter($filter)->paginate(10);
        return view('location.feedback-list', compact('feedbacks'));
    }

    public function resultFeedback(
        Request $request,
        FeedbackFilterResultFilter $filter,
        ResultFeedbackAction $resultFeedback
    ) {
        $page = $resultFeedback->hande($request, $filter);
        return view('location.feedback-success', compact('page'));
    }

    public function store(
        FeedbackRequest $request,
        StoreFeedbackAction $storeFeedback,
    ): Redirector|RedirectResponse {
        $result = $storeFeedback->handle($request);
        if (!$result['result'] && empty($result['hash'])) return redirect(route(RouteServiceProvider::ROUTE_NAME_GUEST));
        return redirect(route('location.result', [
            'hash' => $result['hash'],
            'result' => $result['result'] ? PageTypeSetings::POSITIVE->value : PageTypeSetings::NEGATIVE->value,
        ]));
    }

    public function show(
        Request $request,
        ShowFeedbackAction $showFeedback
    ): View {
        $data = $showFeedback->handle($request);
        return view('location.feedback', compact('data'));
    }

    public function destroy(Feedback $feedback)
    {
        $result = app(LocationFeedbackRepository::class)->updateFeedback(
            Feedback::filter(
                new FeedbackFilter(null),
                [
                    'id' => $feedback->id
                ]
            ),
            ['is_actual' => 0]
        );

        return $this->prepareResultForUpdate(
            $result,
            'Succes Deleted',
            'Error Deleted',
            'feedback.index'
        );
    }
}
