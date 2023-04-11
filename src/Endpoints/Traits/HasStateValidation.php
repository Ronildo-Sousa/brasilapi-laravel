<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Endpoints\Traits;

use BrasilApi\BrasilapiLaravel\Endpoints\Enums\StateEnum;

trait HasStateValidation
{
    public function validateState(string $state): ?string
    {
        $states = collect(StateEnum::cases())->map(function (StateEnum $enum) use ($state) {
            return (str($state)->camel() == str($enum->name)->camel()
                || str($state)->camel() == str($enum->value)->camel()
            )
                ? $enum->value
                : null;
        });

        return $states->whereNotNull()->first();
    }
}
