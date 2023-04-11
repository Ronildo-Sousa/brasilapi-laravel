<?php

declare(strict_types=1);

use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\RegionDTO;
use BrasilApi\BrasilapiLaravel\Endpoints\DTOs\StateDTO;
use BrasilApi\BrasilapiLaravel\Facades\BrasilapiLaravel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake([
        config('brasilapi-laravel.base_url') . '/ibge/uf/' . config('brasilapi-laravel.version')
        => Http::response([
            [
                'id' => 11,
                'sigla' => 'RO',
                'nome' => 'Rondônia',
                'regiao' => [
                    'id' => 1,
                    'sigla' => 'N',
                    'nome' => 'Norte',
                ],
            ],
            [
                'id' => 12,
                'sigla' => 'AC',
                'nome' => 'Acre',
                'regiao' => [
                    'id' => 1,
                    'sigla' => 'N',
                    'nome' => 'Norte',
                ],
            ],
            [
                'id' => 13,
                'sigla' => 'AM',
                'nome' => 'Amazonas',
                'regiao' => [
                    'id' => 1,
                    'sigla' => 'N',
                    'nome' => 'Norte',
                ],
            ],
        ]),
        config('brasilapi-laravel.base_url') . '/ibge/uf/' . config('brasilapi-laravel.version') . '/*'
        => Http::response([
            'id' => 13,
            'sigla' => 'AM',
            'nome' => 'Amazonas',
            'regiao' => [
                'id' => 1,
                'sigla' => 'N',
                'nome' => 'Norte',
            ],
        ]),
    ]);
});

it('should be able to get all states', function () {
    $response = BrasilapiLaravel::ibge()->states()->get();
    $firstState = $response->first();

    expect($response)
        ->toBeInstanceOf(Collection::class)
        ->and($firstState)
        ->toBeInstanceOf(StateDTO::class)
        ->and($firstState->region)
        ->toBeInstanceOf(RegionDTO::class);
});

it('should be able to get a single state', function () {
    $state = BrasilapiLaravel::ibge()->states()->find(11);

    expect($state)
        ->toBeInstanceOf(StateDTO::class)
        ->and($state->region)
        ->toBeInstanceOf(RegionDTO::class)
        ->and($state->name)
        ->toBe('Amazonas')
        ->and($state->acronym)
        ->toBe('AM');
});
