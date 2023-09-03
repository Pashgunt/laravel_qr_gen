<?php

namespace App\QR\DTO;

class FeedbackDTO
{
    private array $validated;
    private int $rating;
    private string $feedbackText;
    private string $name;
    private ?string $contact = null;

    public function __construct($validated)
    {
        $this->validated = $validated;
        $this->rating = $validated['rating'];
        $this->feedbackText = $validated['feedback_text'] ?? '';
        $this->name = $validated['name'] ?? '';
        $this->contact = $validated['contact'] ?? null;
    }

    public function getRating(): int
    {
        return $this->rating;
    }
    public function getFeedbackText(): string
    {
        return $this->feedbackText;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getContact(): ?string
    {
        return $this->contact;
    }
    public function getValidatedByKey(string $key): string
    {
        return !empty($this->validated[$key]) ? $this->validated[$key] : '';
    }
}
