<?php

namespace App\Qr\Helpers;

final class Subdomain
{
    final public static function generateRedirectUrl(
        string $subdomain,
        string $path = ''
    ): string {
        return sprintf('http://%s:8888/%s', $subdomain, $path);
    }

    final public static function getSubdomain(string $host): string
    {
        return sprintf('%s%s', current(explode(env('APP_URL'), $host)), env('APP_URL'));
    }
}
