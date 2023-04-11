<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Facades;

use BrasilApi\BrasilapiLaravel\Endpoints\CEP\Cep;
use BrasilApi\BrasilapiLaravel\Endpoints\IBGE\IBGE;
use Illuminate\Support\Facades\Facade;

/**
 * @see \BrasilApi\BrasilapiLaravel\BrasilapiLaravel
 * @method static Cep cep()
 * @method static IBGE ibge()
 */
class BrasilapiLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BrasilApi\BrasilapiLaravel\BrasilapiLaravel::class;
    }
}
