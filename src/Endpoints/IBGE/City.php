<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\IBGE;

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\CityDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class City extends Endpoint
{
    public function get(string $state): ?Collection
    {
        $uri = sprintf('/ibge/municipios/%s/%s', $this->service->version, $state);

        $response = $this->service->api->get($uri);

        if ($response->status() !== Response::HTTP_OK) {
            return null;
        }

        $response = $response->collect();

        $cities = $response->map(function ($city) {
            return new CityDTO(
                $city['codigo_ibge'],
                $city['nome'],
            );
        });

        return $cities;
    }
}
