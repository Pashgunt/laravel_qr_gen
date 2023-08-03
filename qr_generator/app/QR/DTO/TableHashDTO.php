<?php

namespace App\QR\DTO;

class TableHashDTO
{
    private int $tableNumber;
    private string $hashValue;

    public function __construct($tableHashData)
    {
        $this->tableNumber = $tableHashData->table_number;
        $this->hashValue = $tableHashData->hash_value;
    }

    public function getTableNumber(): int
    {
        return $this->tableNumber;
    }

    public function getHashValue(): string
    {
        return $this->hashValue;
    }
}
