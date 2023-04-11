<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\Banks;

trait HasBanks
{
    public function banks()
    {
        return new Bank();
    }
}
