<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\Traits;

use BrasilapiLaravel\Endpoints\IBGE\IBGE;

trait HasIBGE
{
    public function ibge(): IBGE
    {
        return new IBGE();
    }
}
