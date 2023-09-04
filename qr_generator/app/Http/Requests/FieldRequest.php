<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\FunnelFieldDTO;
use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'field' => 'required|string|min:1|max:255',
            'operator' => 'required|string|min:1|max:255',
            'value' => 'nullable|required_without:range,range_to|int',
            'range' => 'nullable|required_without:value|int',
            'range_to' => 'nullable|required_without:value|int',
        ];
    }

    public function makeDTO(): FunnelFieldDTO
    {
        $validated = $this->validated();

        return new FunnelFieldDTO($validated);
    }
}
