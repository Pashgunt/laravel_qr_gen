<?php

namespace App\QR\DTO;

use App\QR\Enums\PageTypeSetings;

class PageSettingDTO
{

    private string $pageType;
    private int $companyID;
    private ?string $titlePositive;
    private ?string $titleNegative;
    private ?string $textPositive;
    private ?string $textNegative;
    private array $mapLinks;
    private  array $mapNames;
    private string $showCompanyContact;

    public function __construct(array $validated)
    {
        $this->pageType = $validated['page_type'];
        $this->companyID = $validated['company_id'];
        $this->titlePositive = $validated['title_positive'] ?? null;
        $this->titleNegative = $validated['title_negative'] ?? null;
        $this->textPositive = $validated['text_positive'] ?? null;
        $this->textNegative = $validated['text_negative'] ?? null;
        $this->mapLinks = $validated['map_links'] ?? [];
        $this->mapNames = $validated['map_names'] ?? [];
        $this->showCompanyContact = $validated['show_company_contact'] ?? '';
    }

    public function getPageType(): string
    {
        return $this->pageType;
    }

    public function getCompanyId(): int
    {
        return $this->companyID;
    }

    public function getTitle(): string
    {
        return $this->getPageType() === PageTypeSetings::POSITIVE->value ?
            $this->titlePositive :
            $this->titleNegative;
    }

    public function getText(): string
    {
        return $this->getPageType() === PageTypeSetings::POSITIVE->value ?
            $this->textPositive :
            $this->textNegative;
    }

    public function getMapLinks(): array
    {
        return $this->mapLinks;
    }

    public function getMapNames(): array
    {
        return $this->mapNames;
    }

    public function getPreapreMapData(): array
    {
        if (empty(array_filter($this->getMapNames())) || empty(array_filter($this->getMapLinks()))) return [];
        return array_combine(
            $this->getMapNames(),
            $this->getMapLinks()
        );
    }

    public function  getShowCompanyContact(): int
    {
        return (int)$this->showCompanyContact === 'on' ? 1 : 0;
    }
}
