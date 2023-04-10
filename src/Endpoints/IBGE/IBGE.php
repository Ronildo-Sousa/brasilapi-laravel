<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\IBGE;

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\RegionDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\StateDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class IBGE extends Endpoint
{
    public string $uri;

    public function states(): self
    {
        return $this;
    }

    public function get(int $quantity = null): ?Collection
    {
        $this->uri = sprintf('/ibge/uf/%s', $this->service->version);

        $response = $this->service->api->get($this->uri);

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
}
