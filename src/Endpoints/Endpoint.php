<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints;

use BrasilApi\BrasilapiLaravel\BrasilapiLaravel;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

abstract class Endpoint
{
    protected BrasilapiLaravel $service;

    public function __construct()
    {
        $this->service = new BrasilapiLaravel();
    }

    protected function search(string $uri): ?Collection
    {
        $response = $this->service->api->get($uri);

        if ($response->status() !== Response::HTTP_OK) {
            return null;
        }

        return $response->collect();
    }
}
