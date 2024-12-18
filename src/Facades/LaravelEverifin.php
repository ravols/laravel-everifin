<?php

namespace Ravols\LaravelEverifin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ravols\LaravelEverifin\LaravelEverifin
 */
class LaravelEverifin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ravols\LaravelEverifin\LaravelEverifin::class;
    }
}
