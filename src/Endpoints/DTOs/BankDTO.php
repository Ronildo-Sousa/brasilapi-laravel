<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\DTOs;

class BankDTO
{
    public readonly string $ispb;

    public readonly int $code;

    public readonly string $name;

    public readonly string $full_name;

    public function __construct(array $data)
    {
        $this->ispb = data_get($data, 'ispb');
        $this->code = data_get($data, 'code');
        $this->name = data_get($data, 'name');
        $this->full_name = data_get($data, 'fullName');
    }
}
