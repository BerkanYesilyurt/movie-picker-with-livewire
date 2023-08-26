<?php

if(!function_exists('checkKeysFrom')){
    function checkKeysFrom(?iterable $result, array $keys): bool
    {
        if(is_null($result))
            return false;

        $collectionOfResult = is_array($result) ? collect($result) : $result;

        return $collectionOfResult->every(function ($value) use ($keys){
            return collect($value)->has($keys);
        });
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
