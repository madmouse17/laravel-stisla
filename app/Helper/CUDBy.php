<?php

namespace App\Helper;

use App\Observers\CUDByObserver;

trait CUDBy
{
    public static function bootCUDBy()
    {
        static::observe(CUDByObserver::class);
    }
}
