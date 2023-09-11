<?php

namespace App\View\Components\Feedback;

use App\Models\Feedback;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeedbackRaw extends Component
{

    public Feedback $feedback;
    public string $showSeparator;

    public function __construct(
        Feedback $feedback,
        string $showSeparator
    ) {
        $this->feedback = $feedback;
        $this->showSeparator = $showSeparator;
    }

    public function isShowSeparator(): bool
    {
        return $this->showSeparator === '1';
    }

    public function getFeedbackRating(): int
    {
        return (int)$this->feedback->rating;
    }

    public function getFeedbackText(): string
    {
        return $this->feedback->feedback_text ? $this->feedback->feedback_text : 'Отзыв отсутствует';
    }

    public function getFeedbackUsername(): string
    {
        return $this->feedback->feedback_user_name ? $this->feedback->feedback_user_name : '-';
    }

    public function getFeedbackCreatedAt(): string
    {
        return date('d.m.y H:i', strtotime($this->feedback->created_at));
    }

    public function render(): View|Closure|string
    {
        return view('components.feedback.feedback-raw');
    }
}
