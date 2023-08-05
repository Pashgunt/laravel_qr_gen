<?php

namespace App\QR\DTO;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class QrLinkDTO
{

    private ?int $companyID = null;
    private ?string $name = null;
    private ?string $adress = null;
    private ?string $link = null;
    private ?int $placeSitFrom = null;
    private ?int $placeSitTo = null;
    private ?array $placeSitNumbers = null;
    private ?array $hashParams;

    public function __construct($validateData)
    {
        $this->name = $validateData['name'];
        $this->adress = $validateData['adress'];
        $this->companyID = $validateData['company_id'] ?? null;
        $this->link = $validateData['link'] ?? null;
        $this->placeSitFrom = $validateData['place_sit_from'] ?? null;
        $this->placeSitTo = $validateData['place_sit_to'] ?? null;
        $this->placeSitNumbers = $validateData['place_sit_number'] ?? null;
        $this->hashParams = $this->prepareHashParamsForTables();
    }

    private function prepareHashParamsForTables(): array
    {
        $result = [];
        if ($this->getPlaceSitFrom()) {
            for ($placeNumber = $this->getPlaceSitFrom(); $placeNumber <= $this->getPlaceSitTo(); $placeNumber += 1)
                $result[$placeNumber] = $this->generateHashParam($placeNumber);
        }
        if ($this->getPlaceSitNumbers() && array_filter(array_values($this->getPlaceSitNumbers()))) {
            foreach ($this->getPlaceSitNumbers() as $placeNumber)
                $result[$placeNumber] = $this->generateHashParam($placeNumber);
        }

        return $result ?: [$this->generateHashParam()];
    }

    private function generateHashParam(int $saltNumber = 0): string
    {
        return Crypt::encryptString($this->getName());
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getPlaceSitFrom(): ?int
    {
        return $this->placeSitFrom;
    }

    public function getPlaceSitTo(): ?int
    {
        return $this->placeSitTo;
    }

    public function getPlaceSitNumbers(): ?array
    {
        return $this->placeSitNumbers;
    }

    public function getHashParams(): ?array
    {
        return $this->hashParams;
    }

    public function getCompanyID(): ?int
    {
        return $this->companyID;
    }
}
