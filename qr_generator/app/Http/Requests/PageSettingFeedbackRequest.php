<?php

namespace App\Http\Requests;

use App\QR\Abstracts\RequestInterface;
use App\QR\DTO\PageSettingDTO;
use Illuminate\Foundation\Http\FormRequest;

class PageSettingFeedbackRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page_type' => 'required',
            'company_id' => 'required|integer|min:1|exists:companies,id',
            'title_positive' => 'nullable|required_without:title_negative|string',
            'text_positive' => 'nullable|required_without:text_negative|string',
            'title_negative' => 'nullable|required_without:title_positive|string',
            'text_negative' => 'nullable|required_without:text_positive|string',
            'map_links' => 'nullable|array',
            'map_links.*' => 'nullable|string',
            'map_names' => 'nullable|array',
            'map_names.*' => 'nullable|string',
            'show_company_contact' => 'nullable',
        ];
    }

    public function makeDTO(): PageSettingDTO
    {
        $validated = $this->validated();

        return new PageSettingDTO($validated);
    }
}
