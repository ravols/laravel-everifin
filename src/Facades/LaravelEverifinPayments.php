<?php

namespace Ravols\LaravelEverifin\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelEverifinPayments extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ravols\LaravelEverifin\LaravelEverifinPayments::class;
    }
}
