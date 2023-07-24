<?php

namespace App\QR\DTO;

class CompanyDTO
{
    private int $companyID;
    private string $companyName;
    private string $companyAddress;
    private ?string $companyLink;

    public function __construct($companyData)
    {
        $this->companyID = $companyData->id;
        $this->companyName = $companyData->name;
        $this->companyAddress = $companyData->adress;
        $this->companyLink = $companyData->link;
    }

    public function getCompanyID(){
        return $this->companyID;
    }

    public function getCompanyName(){
        return $this->companyName;
    }

    public function getCompanyAdress(){
        return $this->companyAddress;
    }

    public function getCompanyLink(){
        return $this->companyLink;
    }
}
