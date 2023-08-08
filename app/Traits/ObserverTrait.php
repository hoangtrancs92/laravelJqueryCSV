<?php

namespace App\Traits;

use App\Observers\ModelObserver;
use Illuminate\Support\Str;

trait ObserverTrait
{
    public static function bootObservantTrait()
    {
        static::observe(new ModelObserver);
    }
}
