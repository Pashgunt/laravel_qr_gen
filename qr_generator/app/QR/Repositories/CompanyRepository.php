<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository extends Repositories
{
    public function createCompany(
        string $name,
        string $adress,
        ?string $link
    ): Model {
        return $this->create([
            'name' => $name,
            'adress' => $adress,
            'link' => $link,
        ]);
    }

    public function updateCompany(
        int $companyID,
        array $update
    ): bool {
        return $this->update($this->model->where('id', $companyID), $update);
    }
}
