<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\FunnelDTO;
use Illuminate\Foundation\Http\FormRequest;

class FunnelRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'funnel_type' => 'required|integer|min:1|exists:funnel_types,id',
            'field' => 'required|array',
            'field.*' => 'required|string|min:1|max:255',
            'operator' => 'required|array',
            'operator.*' => 'required|string|min:1|max:255',
            'value' => 'required|array',
            'value.*' => 'nullable|int',
            'range' => 'required|array',
            'range.*' => 'nullable|int',
            'range_to' => 'required|array',
            'range_to.*' => 'nullable|int',
            'logic' => 'nullable|array',
            'logic.*' => 'nullable|string|min:1|max:255',
            'work_start' => 'required|date'
        ];
    }

    public function makeDTO()
    {
        $validated = $this->validated();
        return new FunnelDTO($validated);
    }
}
