<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\DTOs;

class CityDTO
{
    public readonly string $code;

    public readonly string $name;

    public function __construct(array $data)
    {
        $this->name = data_get($data, 'nome');
        $this->code = data_get($data, 'codigo_ibge');
    }
}
