<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\FeedbackDTO;
use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest implements RequestInterface
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:0|max:5',
            'feedback_text' => 'nullable|alpha_num|max:255|min:0',
            'is_contact' => 'nullable',
            'name' => 'nullable|required_with_all:is_contact|alpha_num|max:255|min:2',
            'contact' => 'nullable|required_with_all:is_contact'
        ];
    }

    public function attributes(): array
    {
        return [
            'rating' => 'Рейтинг',
            'feedback_text' => 'Текст отзыва',
            'name' => 'Имя',
            'contact' => 'Контактные данные',
        ];
    }

    public function messages(): array
    {
        return [
            'rating.required' => 'Поле обязательно к заполнению',
            'rating.max' => 'Максимальная возможная оценка 5',
            'rating.min' => 'Минимальная возможная оценка 0',
            'feedback_text.alpha_num' => 'Поле не должно содержать спецсимволов',
            'feedback_text.max' => 'Макисмальное количество символов 255',
            'name.required_with_all' => 'Поле обязательно к заполнению',
            'name.alpha_num' => 'Поле не должно содержать спецсимволов',
            'name.max' => 'Макисмальное количество символов 255',
            'name.min' => 'Минимальное количество символов 2',
            'contact.required_with_all' => 'Поле обязательно к заполнению',
        ];
    }

    public function makeDTO(): FeedbackDTO
    {
        $validated = $this->validated();
        return new FeedbackDTO($validated);
    }
}
