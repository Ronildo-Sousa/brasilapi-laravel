<?php

declare(strict_types=1);

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\LocationDTO;
use BrasilApi\BrasilapiLaravel\Facades\BrasilapiLaravel;
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
        ->toBeInstanceOf(LocationDTO::class)
        ->and($response->cep)
        ->toBe('89010025')
        ->and($response->state)
        ->toBe('SC')
        ->and($response->city)
        ->toBe('Blumenau');
});
