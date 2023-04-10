<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\IBGE;

trait HasIBGE
{
    public function ibge()
    {
        return new IBGE();
    }
}
