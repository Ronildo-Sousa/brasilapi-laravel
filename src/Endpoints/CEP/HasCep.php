<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\CEP;

trait HasCep
{
    public function cep()
    {
        return new Cep();
    }
}
