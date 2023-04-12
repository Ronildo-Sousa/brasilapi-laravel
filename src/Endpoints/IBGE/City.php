<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\IBGE;

use BrasilapiLaravel\Endpoints\DTOs\CityDTO;
use BrasilapiLaravel\Endpoints\Endpoint;
use BrasilapiLaravel\Endpoints\Traits\HasStateValidation;
use Illuminate\Support\Collection;

class City extends Endpoint
{
    use HasStateValidation;

    public function get(string $state): ?Collection
    {
        $validState = $this->validateState($state);
        if (! $validState) {
            return null;
        }

        $uri = sprintf('/ibge/municipios/%s/%s', $this->service->version, $validState);
        $response = $this->search($uri);

        return $response->map(fn ($city) => new CityDTO($city));
    }
}
