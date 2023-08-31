<?php

namespace App\QR\Services\Guards;

use App\Models\SubdomainAuth;
use App\Providers\SubdomainAuthProvider;
use Illuminate\Http\Request;

class SubdomainGuard
{
    protected Request $request;
    protected SubdomainAuthProvider $provider;
    protected ?SubdomainAuth $subdomain;

    public function __construct(SubdomainAuthProvider $provider, Request $request)
    {
        $this->request = $request;
        $this->provider = $provider;
        $this->subdomain = null;
    }

    public function check(): bool
    {
        return !is_null($this->subdomain());
    }

    public function logout(): void
    {
        $this->setSubdomain(null);
    }

    public function guest(): bool
    {
        return !$this->check();
    }

    public function subdomain()
    {
        if (!is_null($this->subdomain)) {
            return $this->subdomain;
        }
        return null;
    }

    public function id(): string|null
    {
        if ($subdomain = $this->subdomain()) {
            return $this->subdomain()?->id;
        }
        return null;
    }

    private function checkCredetials(array $credentials = []): bool
    {
        return !empty($credentials['subdomain']) && !empty($credentials['email']);
    }

    public function validateEmail(array $credentials = [])
    {
        if (empty($credentials['subdomain'])) return false;
        $subdomain = $this->provider->retrieveByCredentialSubdomain($credentials);
        if ($subdomain && $this->provider->validateCredetialSubdomain($subdomain, $credentials)) {
            $this->setSubdomain($subdomain);
            return true;
        }

        return false;
    }

    public function validate(array $credentials = []): bool
    {
        if (!$this->checkCredetials($credentials)) return false;
        $subdomain = $this->provider->retrieveByCredentials($credentials);
        if ($subdomain && $this->provider->validateCredetials($subdomain, $credentials)) {
            $this->setSubdomain($subdomain);
            return true;
        }

        return false;
    }

    public function checkCurrentSubdomain(array $credentials = []): bool
    {
        if (!$subdomain = $this->subdomain()) return false;
        return $this->provider->validateCredetials(
            $this->subdomain(),
            $credentials
        );
    }

    public function hasSubdomain(): bool
    {
        return !!$this->subdomain();
    }

    public function setSubdomain(?SubdomainAuth $subdomain): SubdomainGuard
    {
        $this->subdomain = $subdomain;
        return $this;
    }
}
