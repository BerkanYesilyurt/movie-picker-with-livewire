<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

if(!function_exists('checkKeysFromResult')){
    function checkKeysFromResult(Collection $result, array $keys): bool
    {
        return $result->has($keys);
    }
}

if(!function_exists('remember')){
    function remember(string $key, int $seconds, $model = null, $data = null)
    {
        Cache::remember($key, $seconds, function () use ($data, $model) {
            return $model ? app("App\\Models\\$model")->get() : $data;
        });
    }
}
