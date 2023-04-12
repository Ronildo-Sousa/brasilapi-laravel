<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\IBGE;

use BrasilapiLaravel\Endpoints\DTOs\StateDTO;
use BrasilapiLaravel\Endpoints\Endpoint;
use BrasilapiLaravel\Endpoints\Traits\HasStateValidation;
use Illuminate\Support\Collection;

class State extends Endpoint
{
    use HasStateValidation;

    public function find(string $state): ?StateDTO
    {
        $validState = $this->validateState($state);
        if (! $validState) {
            return null;
        }

        $uri = sprintf('/ibge/uf/%s/%s', $this->service->version, $state);
        $response = $this->search($uri);

        return new StateDTO($response->toArray());
    }

    public function get(): ?Collection
    {
        $uri = sprintf('/ibge/uf/%s', $this->service->version);
        $response = $this->search($uri);

        return $response->map(fn ($state) => new StateDTO($state));
    }
}
