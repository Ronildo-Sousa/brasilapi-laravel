<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\DTOs;

class RegionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $acronym,
        public readonly string $name,
    ) {
    }
}
