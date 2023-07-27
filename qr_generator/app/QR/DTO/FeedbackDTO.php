<?php

namespace App\QR\DTO;

class FeedbackDTO
{
    private int $rating;
    private string $feedbackText;
    private string $name;
    private ?string $contact = null;

    public function __construct($validated)
    {
        $this->rating = $validated['rating'];
        $this->feedbackText = $validated['feedback_text'];
        $this->name = $validated['name'];
        $this->contact = $validated['contact'] ?? null;
    }

    public function getRating()
    {
        return $this->rating;
    }
    public function getFeedbackText()
    {
        return $this->feedbackText;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getContact()
    {
        return $this->contact;
    }
}
