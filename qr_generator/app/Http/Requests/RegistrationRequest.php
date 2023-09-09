<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\UserDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль',
            'password_confirmation' => 'Подтверждение пароля',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле обязательно к заполнению',
            'email.email' => 'Укажите корректную почту',
            'email.unique' => 'Такой пользователь уже существует',
            'password.*' => 'Пароль должен содержать буквы в верхнем и нижнем регистре, цифры, спец-символы',
            'password_confirmation.required' => 'Поле обязательно к заполнению',
            'password_confirmation.same' => 'Не совпадает с полем Пароль',
        ];
    }

    public function makeDTO(): UserDTO
    {
        $validated = $this->validated();
        return new UserDTO($validated);
    }
}
