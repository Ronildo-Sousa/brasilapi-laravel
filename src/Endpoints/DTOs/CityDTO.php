<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\DTOs;

class CityDTO
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
    ) {
    }
}
