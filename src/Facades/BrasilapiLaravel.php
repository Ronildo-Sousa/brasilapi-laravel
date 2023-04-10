<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BrasilApi\BrasilapiLaravel\BrasilapiLaravel
 */
class BrasilapiLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BrasilApi\BrasilapiLaravel\BrasilapiLaravel::class;
    }
}
