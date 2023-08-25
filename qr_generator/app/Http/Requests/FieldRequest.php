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
            'value' => 'required|int',
            'range' => 'required|int',
            'range_to' => 'required|int',
        ];
    }

    public function makeDTO(): FunnelFieldDTO
    {
        $validated = $this->validated();

        return new FunnelFieldDTO($validated);
    }
}
