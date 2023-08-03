<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\UserDTO;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email'
        ];
    }

    public function makeDTO(): UserDTO
    {
        $validated = $this->validated();
        return new UserDTO($validated);
    }
}
