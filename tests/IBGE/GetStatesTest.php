<?php

declare(strict_types=1);

use BrasilapiLaravel\Endpoints\DTOs\RegionDTO;
use BrasilapiLaravel\Endpoints\DTOs\StateDTO;
use BrasilapiLaravel\Facades\BrasilapiLaravel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake([
        config('brasilapi-laravel.base_url').'/ibge/uf/'.config('brasilapi-laravel.version') => Http::response([
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
        config('brasilapi-laravel.base_url').'/ibge/uf/'.config('brasilapi-laravel.version').'/*' => Http::response([
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
    $state = BrasilapiLaravel::ibge()->states()->find('AM');

    expect($state)
        ->toBeInstanceOf(StateDTO::class)
        ->and($state->region)
        ->toBeInstanceOf(RegionDTO::class)
        ->and($state->name)
        ->toBe('Amazonas')
        ->and($state->acronym)
        ->toBe('AM');
});

it('should not be able to get an invalid state', function () {
    $state = BrasilapiLaravel::ibge()->states()->find('invalid');

    expect($state)
        ->toBeNull();
});
