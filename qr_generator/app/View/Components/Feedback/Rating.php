<?php

namespace App\View\Components\Feedback;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Rating extends Component
{

    public string $title;
    public array $data;

    public function __construct(
        string $title,
        array $data
    ) {
        $this->title = $title;
        $this->data = $data;
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
