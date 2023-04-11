<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\DTOs;

class AddressDTO
{
    public function __construct(
        public readonly string $cep,
        public readonly string $state,
        public readonly ?string $street,
        public readonly string $city,
        public readonly ?string $neighborhood,
    ) {
    }
}
