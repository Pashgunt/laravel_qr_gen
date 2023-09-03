<?php

namespace App\QR\DTO;

class NotificationConfigDTO
{

    private int $companyID;
    private string $email;
    private string $isSendPositive;
    private string $isSendNegative;

    public function __construct(array $validated)
    {
        $this->companyID = $validated['company_id'];
        $this->email = $validated['email'];
        $this->isSendPositive = $validated['send_positive'] ?? '';
        $this->isSendNegative = $validated['send_negative'] ?? '';
    }

    public function getCompanyID(): int
    {
        return $this->companyID;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIsSendNegative(): int
    {
        return $this->isSendNegative === 'on' ? 1 : 0 ;
    }

    public function getIsSendPositive(): int
    {
        return $this->isSendPositive === 'on' ? 1 : 0;
    }
}
