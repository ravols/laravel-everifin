<?php

namespace Ravols\LaravelEverifin\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelEverifinOrders extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ravols\LaravelEverifin\LaravelEverifinOrders::class;
    }
}
