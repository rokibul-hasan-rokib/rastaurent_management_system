<?php

namespace App\Manager;

use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Random\RandomException;

class Utility
{
    /**
     * @throws RandomException
     */
    final public static function prepare_name(string $name = 'no-name-user'): string
    {
        return Str::slug($name . '-' . str_replace(' ', '-', Carbon::now()->toDayDateTimeString() . '-' . random_int(1000, 9999)));
    }
}