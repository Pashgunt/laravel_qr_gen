<?php

namespace App\QR\Helpers;

final class Arrays
{
    final public static function index(
        array $array,
        string $index
    ): array {
        return array_combine(array_column($array, $index), $array);
    }

    final public static function group(
        array $array,
        string $index
    ): array {
        return array_reduce($array, function ($acc, $item) use ($index) {
            $acc[$item[$index]] = $acc[$item[$index]] ?? [];
            $acc[$item[$index]][] = $item;
            return $acc;
        }, []);
    }
}
