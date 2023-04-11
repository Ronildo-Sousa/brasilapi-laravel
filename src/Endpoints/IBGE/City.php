<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\IBGE;

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\CityDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;
use BrasilApi\BrasilapiLaravel\Endpoints\Enums\StateEnum;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class City extends Endpoint
{
    public function get(string $state): ?Collection
    {
        $validState = $this->validateState($state);
        if (! $validState) {
            return null;
        }

        $uri = sprintf('/ibge/municipios/%s/%s', $this->service->version, $validState);
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

    public function validateState(string $state)
    {
        $states = collect(StateEnum::cases())->map(function (StateEnum $enum) use ($state) {
            return (str($state)->camel() == str($enum->name)->camel()
                || str($state)->camel() == str($enum->value)->camel()
            )
                ? $enum->value
                : null;
        });

        return $states->whereNotNull()->first();
    }
}
