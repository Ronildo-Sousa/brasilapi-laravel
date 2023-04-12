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
        config('brasilapi-laravel.base_url').'/banks/'.config('brasilapi-laravel.version').'/*' => Http::response(
            [
                'ispb' => '00000000',
                'name' => 'BCO DO BRASIL S.A.',
                'code' => 1,
                'fullName' => 'Banco do Brasil S.A.',
            ]
        ),
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

it('should be able to get a bank based on a code', function () {
    $bank = BrasilapiLaravel::banks()->find(1);

    expect($bank)
        ->toBeInstanceOf(BankDTO::class)
        ->and($bank->name)
        ->toBe('BCO DO BRASIL S.A.')
        ->and($bank->ispb)
        ->toBe('00000000');
});
