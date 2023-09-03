<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class PageSettingLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'map_link' => 'required|string',
            'map_name' => 'required|string',
        ];
    }
}
