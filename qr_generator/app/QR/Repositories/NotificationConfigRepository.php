<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;

class NotificationConfigRepository extends Repositories
{
    public function createConfig(
        int $companyId,
        string $email,
        int $isSendPositive,
        int $isSendNegative
    ) {
        return $this->create([
            'company_id' => $companyId,
            'email' => $email,
            'is_send_positive' => $isSendPositive,
            'is_send_negative' => $isSendNegative,
        ]);
    }

    public function updateConfig(
        $raw,
        array $update
    ) {
        return $this->update($raw, $update);
    }
}
