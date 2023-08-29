<?php

namespace App\Providers;

use App\Models\SubdomainAuth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class SubdomainAuthProvider extends ServiceProvider
{

    private SubdomainAuth $model;

    public function __construct(SubdomainAuth $subdomain)
    {
        $this->model = $subdomain;
    }

    public function retrieveByCredentials(array $credentials): Collection|null
    {
        if (empty($credentials)) {
            return null;
        }
        $subdomain = $this->model->where([
            'subdomain' => $credentials['subdomain'],
            'email' => $credentials['email']
        ])->get();
        return $subdomain;
    }

    public function validateCredetials(
        SubdomainAuth $subdomain,
        array $credentials = []
    ) {
        if (!$subdomain) return false;
        return $subdomain->subdomain === $credentials['subdomain']
            && $subdomain->email === $credentials['email'];
    }
}
