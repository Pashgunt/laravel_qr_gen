<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Model;

class CompanyTableHashRepository extends Repositories
{
    public function createHashForCompany(
        int $companyID,
        int $tableNumber,
        string $hashValue
    ): Model {
        return $this->create([
            'company_id' => $companyID,
            'table_number' => $tableNumber,
            'hash_value' => $hashValue,
        ]);
    }

    public function updateCompanyTableHash(
        $raw,
        array $update
    ): bool {
        return $this->update($raw, $update);
    }
}
