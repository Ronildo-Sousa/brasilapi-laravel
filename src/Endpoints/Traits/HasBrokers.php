<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\Traits;

use BrasilapiLaravel\Endpoints\Brokers\Broker;

trait HasBrokers
{
    public function brokers(): Broker
    {
        return new Broker();
    }
}
