<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\QrLinkDTO;
use Illuminate\Foundation\Http\FormRequest;

class QrGenerationLinkRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'create_new_company' => 'nullable',
            'company_id' => 'nullable|required_with_all:create_new_company|integer|exists:companies,id',
            'name' => 'nullable|required_without:company_id',
            'adress' => 'nullable|required_without:company_id',
            'link' => 'nullable|max:255|min:2|regex:/^(https?:\/\/)?([\w-]{1,32}\.[\w-]{1,32})[^\s@]*$/mx',
            'places_sit_areas' => 'nullable',
            'place_sit_from' => 'nullable|required_with_all:places_sit_areas|integer|min:0',
            'place_sit_to' => 'nullable|required_with_all:places_sit_areas|integer|min:1',
            'place_sit_numbers' => 'nullable',
            'place_sit_number' => 'nullable|required_with_all:place_sit_numbers|array',
            'place_sit_number.*' => 'nullable|required_with_all:place_sit_numbers|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required_with_all' => 'Поле обязательно к заполнению',
            'company_id.integer' => 'Выберите корректную организацию',
            'company_id.exists' => 'Выберите корректную организацию',
            'name.required_without' => 'Поле обязательно к заполнению',
            'adress.required_without' => 'Поле обязательно к заполнению',
            'link.min' => 'Минимальная длина 2 символа',
            'link.max' => 'Максимальная длина 255 символов',
            'link.regex' => 'Поле должно соответствовать шаблону https://domai',
            'place_sit_from.required_with_all' => 'Поле обязательно к заполнению',
            'place_sit_to.required_with_all' => 'Поле обязательно к заполнению',
            'place_sit_from.integer' => 'Поле должно быть в числовом формате',
            'place_sit_to.integer' => 'Поле должно быть в числовом формате',
            'place_sit_from.min' => 'Минимальное значение 0',
            'place_sit_to.min' => 'Минимальное значение 1',
        ];
    }

    public function makeDTO(): QrLinkDTO
    {
        $validated = $this->validated();
        return  new QrLinkDTO($validated);
    }
}
