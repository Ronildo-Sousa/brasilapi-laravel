<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\Banks;

use BrasilapiLaravel\Endpoints\DTOs\BankDTO;
use BrasilapiLaravel\Endpoints\Endpoint;
use Illuminate\Support\Collection;

class Bank extends Endpoint
{
    public function get(): ?Collection
    {
        $uri = sprintf('/banks/%s', $this->service->version);
        $response = $this->search($uri);

        return $response->map(fn ($bank) => new BankDTO($bank));
    }

    public function find(int $code): ?BankDTO
    {
        $uri = sprintf('/banks/%s/%s', $this->service->version, $code);
        $response = $this->search($uri);

        return new BankDTO($response->toArray());
    }
}
