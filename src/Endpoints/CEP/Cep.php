<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\CEP;

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\LocationDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\Endpoint;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Cep extends Endpoint
{
    public string $current = '';

    public function cep(): self
    {
        return $this;
    }

    public function find(string $cep)
    {
        $validated = $this->validate($cep);
        if (empty($this->current)) {
            return $validated;
        }

        $uri = sprintf('/cep/%s/%s', $this->service->version, $this->current);

        $response = $this->service->api->get($uri);

        if ($response->status() !== Response::HTTP_OK) {
            return null;
        }
        $response = $response->collect();

        return new LocationDTO(
            $response->get('cep'),
            $response->get('state'),
            $response->get('street'),
            $response->get('city'),
            $response->get('neighborhood'),
        );
    }

    private function validate(string $value): ?array
    {
        $validator = Validator::make(
            ['cep' => $value],
            ['cep' => ['required', 'string', 'size:8']],

        );
        if ($validator->fails()) {
            return $validator->errors()->get('cep');
        }
        $this->current = $value;

        return null;
    }
}
