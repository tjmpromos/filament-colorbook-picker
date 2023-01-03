<?php

namespace Dymond\FilamentColorbookPicker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \dymond\FilamentColorbookPicker\FilamentColorbookPicker
 */
class FilamentColorbookPicker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \dymond\FilamentColorbookPicker\FilamentColorbookPicker::class;
    }
}
