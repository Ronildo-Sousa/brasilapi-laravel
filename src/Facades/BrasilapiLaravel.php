<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Facades;

use BrasilapiLaravel\Endpoints\Banks\Bank;
use BrasilapiLaravel\Endpoints\Brokers\Broker;
use BrasilapiLaravel\Endpoints\CEP\Cep;
use BrasilapiLaravel\Endpoints\IBGE\IBGE;
use Illuminate\Support\Facades\Facade;

/**
 * @see \BrasilapiLaravel\BrasilapiLaravel
 * @method static Cep cep()
 * @method static IBGE ibge()
 * @method static Bank banks()
 * @method static Broker brokers()
 */
class BrasilapiLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BrasilapiLaravel\BrasilapiLaravel::class;
    }
}
