<?php

namespace App\QR\Repositories;

use App\Models\CompanyTableHash;

class CompanyTableHashRepository
{
    public function createHashForCompany(
        int $companyID,
        int $tableNumber,
        string $hashValue
    ) {
        return CompanyTableHash::create([
            'company_id' => $companyID,
            'table_number' => $tableNumber,
            'hash_value' => $hashValue,
        ]);
    }

    public function checkIssetHashString(string $hashValue)
    {
        return CompanyTableHash::query()
            ->where('hash_value', '=', $hashValue)
            ->first();
    }
}
