<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints;

use BrasilApi\BrasilapiLaravel\BrasilapiLaravel;

abstract class Endpoint
{
    protected BrasilapiLaravel $service;

    public function __construct()
    {
        $this->service = new BrasilapiLaravel();
    }
}
