<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\IBGE;

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\CityDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;
use BrasilApi\BrasilapiLaravel\Endpoints\Traits\HasStateValidation;
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

        return $response->map(function ($city) {
            return new CityDTO($city);
        });
    }
}
