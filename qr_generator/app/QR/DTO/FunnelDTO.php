<?php

namespace App\QR\DTO;

class FunnelDTO
{

    private int $companyID;
    private int $funnelID;
    private array $fields;
    private array $operators;
    private array $values;
    private array $rangeFrom;
    private array $rangeTo;
    private array $logic;
    private string $workStart;

    public function __construct($validated)
    {
        $this->companyID = $validated['company_id'];
        $this->funnelID = $validated['funnel_type'];
        $this->fields = $validated['field'];
        $this->operators = $validated['operator'];
        $this->values = $validated['value'];
        $this->rangeFrom = $validated['range'];
        $this->rangeTo = $validated['range_to'];
        $this->logic = $validated['logic'];
        $this->workStart = $validated['work_start'];
    }

    public function getCompanyID(): int
    {
        return $this->companyID;
    }

    public function getFunnelID(): int
    {
        return $this->funnelID;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getOperators(): array
    {
        return $this->operators;
    }

    public function getRange(): array
    {
        return array_map(function ($rangeItem, $keyRangeItem) {
            return [
                'from' => $rangeItem,
                'to' => $this->rangeTo[$keyRangeItem]
            ];
        }, $this->rangeFrom, array_keys($this->rangeFrom));
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getLogic(): array
    {
        return $this->logic;
    }

    public function getWorkStartDate(): string
    {
        return date("Y-m-d", strtotime($this->workStart));
    }

    public function getPrepareLogicParams(): array
    {
        return array_reduce($this->getLogic(), function ($carry, $logicElems) {
            if (is_null($logicElems)) $logicElems = $carry['i'];
            $rangeItem = $this->getRange()[$carry['i']];
            $rangeItem['operator'] = $this->getOperators()[$carry['i']];
            $rangeItem['value'] = $this->getValues()[$carry['i']];
            $rangeItem['field'] = $this->getFields()[$carry['i']];
            $carry['i']++;
            $carry['result'][$logicElems] = $rangeItem;
            return $carry;
        }, ['result' => [], 'i' => 0])['result'];
    }
}
