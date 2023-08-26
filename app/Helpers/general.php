<?php

use Illuminate\Support\Collection;

if(!function_exists('checkKeysFromResult')){
    function checkKeysFromResult(Collection $result, array $keys): bool
    {
        return $result->has($keys);
    }
}

if(!function_exists('remember')){
    function remember(string $key, int $seconds = 300, $model = null, $data = null)
    {
        if($model || $data)
            return cache()->remember($key, $seconds, function () use ($data, $model) {
                return $model ? app("App\\Models\\$model")->get() : $data;
            });
        else
            return null;
    }
}
