<?php

declare(strict_types=1);

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\BankDTO;
use BrasilApi\BrasilapiLaravel\Facades\BrasilapiLaravel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake([
        config('brasilapi-laravel.base_url').'/banks/'.config('brasilapi-laravel.version') => Http::response([
            [
                'ispb' => '00000000',
                'name' => 'BCO DO BRASIL S.A.',
                'code' => 1,
                'fullName' => 'Banco do Brasil S.A.',
            ],
            [
                'ispb' => '00000000',
                'name' => 'BCO DO BRASIL S.A.',
                'code' => 1,
                'fullName' => 'Banco do Brasil S.A.',
            ],
        ]),
    ]);
    Http::fake([
        config('brasilapi-laravel.base_url').'/banks/'.config('brasilapi-laravel.version').'/*' => Http::response([
            [
                'ispb' => '00000000',
                'name' => 'BCO DO BRASIL S.A.',
                'code' => 1,
                'fullName' => 'Banco do Brasil S.A.',
            ],
        ]),
    ]);
});

it('should be able to get all banks from brasil', function () {
    $banks = BrasilapiLaravel::banks()->get();
    $firstBank = $banks->first();

    expect($banks)
        ->toBeInstanceOf(Collection::class)
        ->and($firstBank)
        ->toBeInstanceOf(BankDTO::class)
        ->and($banks->last())
        ->toBeInstanceOf(BankDTO::class);
});
