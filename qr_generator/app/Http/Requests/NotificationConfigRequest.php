<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\NotificationConfigDTO;
use Illuminate\Foundation\Http\FormRequest;

class NotificationConfigRequest extends FormRequest implements RequestInterface
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => 'required|integer|exists:companies,id',
            'email' => 'required|email',
            'send_positive' => 'nullable|string',
            'send_negative' => 'nullable|string',
        ];
    }

    public function makeDTO():NotificationConfigDTO
    {
        $validated = $this->validated();

        return new NotificationConfigDTO($validated);
    }
}
