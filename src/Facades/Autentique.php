<?php

namespace ForWebSystem\Autentique\Facades;

use Illuminate\Support\Facades\Facade;

class Autentique extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'autentique';
    }
}
