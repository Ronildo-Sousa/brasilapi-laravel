<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\Brokers;

use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;
use Illuminate\Support\Collection;

class Broker extends Endpoint
{
    public function get(): ?Collection
    {
        $uri = sprintf('/cvm/corretoras/%s', $this->service->version);
        $brokers = $this->search($uri);

        return $brokers->map(fn (array $broker) => new BrokerDTO($broker));
    }

    public function find(string $cnpj): ?BrokerDTO
    {
        $uri = sprintf('/cvm/corretoras/%s/%s', $this->service->version, $cnpj);
        $broker = $this->search($uri);

        return new BrokerDTO($broker->toArray());
    }
}
