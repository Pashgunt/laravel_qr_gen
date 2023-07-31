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
            'rating' => 'required|integer|min:0|max:10',
            'feedback_text' => 'required|alpha_num|max:255|min:2',
            'name' => 'required|alpha_num|max:255|min:2',
            'contact' => 'nullable'
        ];
    }

    public function makeDTO()
    {
        $validated = $this->validated();
        return new FeedbackDTO($validated);
    }
}
