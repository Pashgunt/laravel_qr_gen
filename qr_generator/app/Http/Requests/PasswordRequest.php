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
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Почта',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле обязательно к заполнению',
            'email.email' => 'Укажите корректную почту',
            'email.exists' => 'Укажите корректную почту',
        ];
    }

    public function makeDTO(): UserDTO
    {
        $validated = $this->validated();
        return new UserDTO($validated);
    }
}
