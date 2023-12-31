<?php

namespace App\QR\Abstracts;

trait ComponentClassesTrait
{
    public function getInputErrorClassName(): string
    {
        return 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 block';
    }

    public function getLabelErrorClassName(): string
    {
        return 'text-red-500';
    }

    public function getInnactiveClassName(): string
    {
        return 'opacity-30';
    }
}
