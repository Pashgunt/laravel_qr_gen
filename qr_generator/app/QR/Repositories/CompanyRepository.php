<?php

namespace App\QR\Repositories;

use App\Models\Company;

class CompanyRepository
{
    public function createCompany(
        string $name,
        string $adress,
        ?string $link
    ) {
        return Company::create([
            'name' => $name,
            'adress' => $adress,
            'link' => $link,
        ]);
    }
}
