<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\Traits;

use BrasilapiLaravel\Endpoints\CEP\Cep;

trait HasCep
{
    public function cep(): Cep
    {
        return new Cep();
    }
}
