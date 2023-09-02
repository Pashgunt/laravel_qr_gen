<?php

namespace App\QR\Repositories;

use App\Models\FeedbackFilter;
use App\QR\Abstracts\Repositories;

class FeedbackFilterRepository extends Repositories
{
    public function createFeedbackFilterResult(
        int $feedbackID,
        bool $filterResult,
        string $filterResultDescription,
        string $hash
    ): FeedbackFilter {
        return $this->create([
            'feedback_id' => $feedbackID,
            'filter_result' => $filterResult,
            'filter_result_descripton' => $filterResultDescription,
            'hash' => $hash,
        ]);
    }

    public function updateFeedbackFilterResult(
        $raw,
        array $update
    ): bool {
        return $this->update($raw, $update);
    }
}
