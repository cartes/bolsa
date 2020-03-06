<?php

namespace App\Helpers;

class Helper
{
    public static function uploadFile($key, $path)
    {
        request()->file($key)->store($path);

        $data = [
          'hashName' => request()->file($key)->hashName(),
          'fileName' => request()->file($key)->getClientOriginalName()
        ];
        return $data;
    }
}