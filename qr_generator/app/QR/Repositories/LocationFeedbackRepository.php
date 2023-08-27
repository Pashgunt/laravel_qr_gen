<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Model;

class LocationFeedbackRepository extends Repositories
{
    public function createNewFeedback(
        int $companyID,
        int $tableID,
        int $rating,
        string $feebackText,
        string $feedbackUserName,
        ?string $contactData
    ): Model {
        return $this->create([
            'company_id' => $companyID,
            'table_id' => $tableID,
            'rating' => $rating,
            'feedback_text' => $feebackText,
            'feedback_user_name' => $feedbackUserName,
            'contact_data' => $contactData,
        ]);
    }

    public function getColumnList(): array
    {
        return $this->columnNames();
    }

    public function updateFeedback(
        $raw,
        array $update
    ) {
        return $this->update($raw, $update);
    }
}
