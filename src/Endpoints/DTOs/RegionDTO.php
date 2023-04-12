<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\DTOs;

class RegionDTO
{
    public readonly int $id;

    public readonly string $acronym;

    public readonly string $name;

    public function __construct(array $data)
    {
        $this->id = data_get($data, 'id');
        $this->acronym = data_get($data, 'sigla');
        $this->name = data_get($data, 'nome');
    }
}
