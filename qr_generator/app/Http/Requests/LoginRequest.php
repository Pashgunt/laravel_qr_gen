<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\UserDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest implements RequestInterface
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль',
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
