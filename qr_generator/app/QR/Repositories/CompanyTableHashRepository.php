<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;

class CompanyTableHashRepository extends Repositories
{
    public function createHashForCompany(
        int $companyID,
        int $tableNumber,
        string $hashValue
    ) {
        return $this->create([
            'company_id' => $companyID,
            'table_number' => $tableNumber,
            'hash_value' => $hashValue,
        ]);
    }
}
