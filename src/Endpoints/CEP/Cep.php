<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\CEP;

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\LocationDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;
use Symfony\Component\HttpFoundation\Response;

class Cep extends Endpoint
{
    public string $current = '';

    public function cep(): self
    {
        return $this;
    }

    public function find(string $cep): LocationDTO
    {
        $this->current = $cep;
        $response = $this->service->api->get("/cep/{$this->current}");

        if ($response->status() !== Response::HTTP_OK) {
            dd($response);
        }

        return new LocationDTO(
            $response->get('cep'),
            $response->get('state'),
            $response->get('street'),
            $response->get('city'),
            $response->get('neighborhood'),
        );
    }
}
