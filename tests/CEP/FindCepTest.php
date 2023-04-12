<?php

declare(strict_types=1);

use BrasilapiLaravel\Endpoints\DTOs\AddressDTO;
use BrasilapiLaravel\Facades\BrasilapiLaravel;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake([
        config('brasilapi-laravel.base_url').'/cep/*' => Http::response([
            'cep' => '89010025',
            'state' => 'SC',
            'city' => 'Blumenau',
            'neighborhood' => 'Centro',
            'street' => 'Rua Doutor Luiz de Freitas Melro - lado par',
        ]),
    ]);
});

it('should be able to find a valid CEP', function () {
    $response = BrasilapiLaravel::cep()->find('89010025');
    expect($response)
        ->toBeInstanceOf(AddressDTO::class)
        ->and($response->cep)
        ->toBe('89010025')
        ->and($response->state)
        ->toBe('SC')
        ->and($response->city)
        ->toBe('Blumenau');
});

test('CEP should be required', function () {
    $response = BrasilapiLaravel::cep()->find('');
    $errors = collect($response);
    expect($response)
        ->toBeArray()
        ->and($errors->first())
        ->toBe('The cep field is required.');
});

test('CEP should be exactly 8 characters', function () {
    $response = BrasilapiLaravel::cep()->find('1');
    $errors = collect($response);
    expect($response)
        ->toBeArray()
        ->and($errors->first())
        ->toBe('The cep field must be 8 characters.');
});
