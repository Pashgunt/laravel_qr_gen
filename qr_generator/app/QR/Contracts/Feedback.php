<?php

namespace App\QR\Contracts;

use Closure;

interface Feedback
{
    public function preparePipeline($data, Closure $next);
}
