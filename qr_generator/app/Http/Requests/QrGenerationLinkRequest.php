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
            'company_id' => 'nullable|required_without:name,adress|integer|exists:companies,id',
            'name' => 'nullable|required_without:company_id|alpha_num|max:255|min:2',
            'adress' => 'nullable|required_without:company_id|alpha_num|max:255|min:2',
            'link' => 'nullable|max:255|min:2|regex:/^(https?:\/\/)?([\w-]{1,32}\.[\w-]{1,32})[^\s@]*$/mx',
            'place_sit_from' => 'nullable|integer',
            'place_sit_to' => 'nullable|integer',
            'place_sit_number' => 'nullable|array',
            'place_sit_number.*' => 'nullable|integer',
        ];
    }

    public function makeDTO(): QrLinkDTO
    {
        $validated = $this->validated();
        return  new QrLinkDTO($validated);
    }
}
