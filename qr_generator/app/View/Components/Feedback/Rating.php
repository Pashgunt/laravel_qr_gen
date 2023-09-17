<?php

namespace App\View\Components\Feedback;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Rating extends Component
{
    public function __construct(
        public string $title,
        public array $data
    ) {
    }

    public function getTotalFeedback(): int
    {
        return $this->data['feedback_list']->total();
    }

    public function getRating(): int|float
    {
        return round($this->data['rating'], 1);
    }

    public function render(): View|Closure|string
    {
        return view('components.feedback.rating');
    }
}
