<?php

namespace App\QR\Helpers;

final class Subdomain
{
    final public static function generateRedirectUrl(
        string $subdomain,
        string $path = ''
    ): string {
        return sprintf('https://%s/%s', $subdomain, $path);
    }

    final public static function getSubdomain(string $host): string
    {
        return sprintf('%s%s', current(explode(env('APP_URL'), $host)), env('APP_URL'));
    }
}
