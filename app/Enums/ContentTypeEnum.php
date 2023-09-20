<?php

namespace App\Enums;

enum ContentTypeEnum: int
{
    case tv = 1;
    case movie = 2;

    public static function getValueOf($key)
    {
        return collect(self::cases())->firstWhere('name', $key)->value;
    }
}
