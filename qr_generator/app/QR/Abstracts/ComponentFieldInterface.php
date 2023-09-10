<?php

namespace App\QR\Abstracts;

interface ComponentFieldInterface
{
    public function isShowError(): bool;
    public function isShowErrorMessage(): bool;
    public function getClassLabelError(): string;
    public function getClassInputError(): string;
}
