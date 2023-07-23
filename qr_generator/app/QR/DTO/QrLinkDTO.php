<?php

namespace App\QR\DTO;

class QrLinkDTO
{

    private string $name;
    private string $adress;
    private ?string $link = null;
    private ?int $placeSitFrom = null;
    private ?int $placeSitTo = null;
    private ?array $placeSitNumbers = null;
    private array $hashParams;

    public function __construct($validateData)
    {
        $this->name = $validateData['name'];
        $this->adress = $validateData['adress'];
        $this->link = $validateData['link'] ?? null;
        $this->placeSitFrom = $validateData['place_sit_from'] ?? null;
        $this->placeSitTo = $validateData['place_sit_to'] ?? null;
        $this->placeSitNumbers = $validateData['place_sit_number'] ?? null;
        $this->hashParams = $this->prepareHashParamsForTables();
    }

    private function prepareHashParamsForTables()
    {
        $result = [];
        if ($this->getPlaceSitFrom()) {
            for ($placeNumber = $this->getPlaceSitFrom(); $placeNumber <= $this->getPlaceSitTo(); $placeNumber += 1)
            $result[$placeNumber] = $this->generateHashParam($placeNumber);
        }
        if (array_filter(array_values($this->getPlaceSitNumbers()))) {
            foreach ($this->getPlaceSitNumbers() as $placeNumber)
                $result[$placeNumber] = $this->generateHashParam($placeNumber);
        }

        return $result ?: [$this->generateHashParam()];
    }

    private function generateHashParam(int $saltNumber = 0)
    {
        return str_replace(['/'], '', sprintf('%s%s%d', uniqid('gen'), bcrypt($this->getName()), $saltNumber));
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getPlaceSitFrom()
    {
        return $this->placeSitFrom;
    }

    public function getPlaceSitTo()
    {
        return $this->placeSitTo;
    }

    public function getPlaceSitNumbers()
    {
        return $this->placeSitNumbers;
    }

    public function getHashParams()
    {
        return $this->hashParams;
    }
}
