<?php

namespace App\QR\DTO;

class FunnelDTO
{

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
        $this->funnelID = $validated['funnel_type'];
        $this->fields = $validated['field'];
        $this->operators = $validated['operator'];
        $this->values = $validated['value'];
        $this->rangeFrom = $validated['range'];
        $this->rangeTo = $validated['range_to'];
        $this->logic = $validated['logic'];
        $this->workStart = $validated['work_start'];
    }

    public function getFunnelID()
    {
        return $this->funnelID;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getOperators()
    {
        return $this->operators;
    }

    public function getRange()
    {
        return array_map(function ($rangeItem, $keyRangeItem) {
            return [
                'from' => $rangeItem,
                'to' => $this->rangeTo[$keyRangeItem]
            ];
        }, $this->rangeFrom, array_keys($this->rangeFrom));
    }

    public function getValues()
    {
        return $this->values;
    }

    public function getLogic()
    {
        return $this->logic;
    }

    public function getWorkStartDate()
    {
        return date("Y-m-d", strtotime($this->workStart));
    }

    public function getPrepareLogicParams()
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
        }, ['result' => [], 'i' => 0]);
    }
}