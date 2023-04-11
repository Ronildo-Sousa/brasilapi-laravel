<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\IBGE;

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\RegionDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\StateDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;
use BrasilApi\BrasilapiLaravel\Endpoints\Enums\StateEnum;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class State extends Endpoint
{
    public function find(string $state): ?StateDTO
    {
        $validState = $this->validateState($state);
        if (!$validState) {
            return null;
        }

        $uri = sprintf('/ibge/uf/%s/%s', $this->service->version, $state);

        $response = $this->service->api->get($uri);

        if ($response->status() !== Response::HTTP_OK) {
            return null;
        }

        $response = $response->collect();

        $region = new RegionDTO(
            $response['regiao']['id'],
            $response['regiao']['sigla'],
            $response['regiao']['nome'],
        );

        return new StateDTO(
            $response['id'],
            $response['sigla'],
            $response['nome'],
            $region
        );
    }

    public function get(): ?Collection
    {
        $uri = sprintf('/ibge/uf/%s', $this->service->version);

        $response = $this->service->api->get($uri);

        if ($response->status() !== Response::HTTP_OK) {
            return null;
        }

        $response = $response->collect();

        $states = $response->map(function ($state) {
            $region = new RegionDTO(
                $state['regiao']['id'],
                $state['regiao']['sigla'],
                $state['regiao']['nome'],
            );

            return new StateDTO(
                $state['id'],
                $state['sigla'],
                $state['nome'],
                $region
            );
        });

        return $states;
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