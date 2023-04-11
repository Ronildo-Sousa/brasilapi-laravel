<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\IBGE;

use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;

class IBGE extends Endpoint
{
    public string $uri;

    public function states(): State
    {
        return new State();
    }

    public function cities(): City
    {
        return new City();
    }
}
