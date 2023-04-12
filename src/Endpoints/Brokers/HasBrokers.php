<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\Brokers;

trait HasBrokers
{
    public function brokers(): Broker
    {
        return new Broker();
    }
}
