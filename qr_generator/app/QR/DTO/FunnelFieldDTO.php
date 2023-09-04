<?php

namespace App\QR\DTO;

class FunnelFieldDTO
{
    private string $fields;
    private string $operators;
    private ?int $value;
    private ?int $rangeFrom;
    private ?int $rangeTo;

    public function __construct($validated)
    {
        $this->fields = $validated['field'];
        $this->operators = $validated['operator'];
        $this->value = $validated['value'];
        $this->rangeFrom = $validated['range'] ?? null;
        $this->rangeTo = $validated['range_to'] ?? null;
    }

    public function getField(): string
    {
        return $this->fields;
    }

    public function getOperator(): string
    {
        return $this->operators;
    }

    public function getRange(): array
    {
        return [
            'from' => $this->rangeFrom ?? null,
            'to' => $this->rangeTo ?? null,
        ];
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
