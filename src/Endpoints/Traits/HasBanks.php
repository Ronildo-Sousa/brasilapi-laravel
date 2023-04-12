<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\Traits;

use BrasilapiLaravel\Endpoints\Banks\Bank;

trait HasBanks
{
    public function banks(): Bank
    {
        return new Bank();
    }
}
