<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;

class SubdomainAuthRepository extends Repositories
{
    public function createSubdomain(
        string $subdomain,
        string $email,
        int $userID
    ) {
        return $this->create([
            'subdomain' => $subdomain,
            'email' => $email,
            'user_id' => $userID,
        ]);
    }
}
