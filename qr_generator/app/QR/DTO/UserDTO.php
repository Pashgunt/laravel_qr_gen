<?php

namespace App\QR\DTO;

use Illuminate\Support\Facades\Hash;

class UserDTO
{
    private array $validated;
    private string $email;
    private ?string $password;
    private ?string $name = null;
    private ?string $token = null;

    public function __construct($validated)
    {
        $this->validated = $validated;
        $this->email = $validated['email'];
        $this->password = $validated['password'] ?? null;
        $this->name = $validated['name'] ?? null;
        $this->token = $validated['token'] ?? null;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        if ($this->name) return $this->name;
        return current(explode('@', $this->email));
    }

    public function getPassword(): ?string
    {
        return Hash::make($this->password);
    }

    public function getPasswordOrigin(): ?string
    {
        return $this->password;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getValidateedData(): array
    {
        return $this->validated;
    }
}
