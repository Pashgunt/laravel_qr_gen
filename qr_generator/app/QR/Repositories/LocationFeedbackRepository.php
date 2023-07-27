<?php

namespace App\QR\Repositories;

use App\Models\Feedback;

class LocationFeedbackRepository
{
    public function createNewFeedback(
        int $companyID,
        int $tableID,
        int $rating,
        string $feebackText,
        string $feedbackUserName,
        ?string $contactData
    ) {
        return Feedback::create([
            'company_id' => $companyID,
            'table_id' => $tableID,
            'rating' => $rating,
            'feedback_text' => $feebackText,
            'feedback_user_name' => $feedbackUserName,
            'contact_data' => $contactData,
        ]);
    }

    public function prepareAvgRatingForComapny(int $companyID)
    {
        return Feedback::query()->where('company_id', '=', $companyID)->avg('rating');
    }

    public function getPaginationFeedbackList(int $companyID, int $perPage)
    {
        return Feedback::query()->where('company_id', '=', $companyID)->paginate($perPage);
    }
}
