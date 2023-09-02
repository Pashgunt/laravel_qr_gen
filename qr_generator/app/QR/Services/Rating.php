<?php

namespace App\QR\Services;

use App\Filters\FeedbackFilter;
use App\Models\Feedback;
use Closure;

class Rating
{
    public FeedbackFilter $feedbackFilter;

    public function __construct(FeedbackFilter $feedbackFilter)
    {
        $this->feedbackFilter = $feedbackFilter;
    }

    public function showFeedbackPipeline(
        array $data,
        Closure $next
    ): array {
        $data['rating'] = Feedback::filter(
            $this->feedbackFilter,
            [
                'company_id' => $data['company']->company_id
            ]
        )->avg('rating') ?? 0;
        return $next($data);
    }
}
