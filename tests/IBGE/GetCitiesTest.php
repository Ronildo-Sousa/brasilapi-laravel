<?php

declare(strict_types=1);

use BrasilapiLaravel\Endpoints\DTOs\CityDTO;
use BrasilapiLaravel\Facades\BrasilapiLaravel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake([
        config('brasilapi-laravel.base_url').'/ibge/municipios/'.config('brasilapi-laravel.version').'/*' => Http::response([

            [
                'nome' => 'ACRELANDIA',
                'codigo_ibge' => '1200013',
            ],
            [
                'nome' => 'ASSIS BRASIL',
                'codigo_ibge' => '1200054',
            ],
            [
                'nome' => 'BRASILEIA',
                'codigo_ibge' => '1200104',
            ],
            [
                'nome' => 'BUJARI',
                'codigo_ibge' => '1200138',
            ],
        ]),
    ]);
});

it('should be able to get cities from a state', function () {
    $cities = BrasilapiLaravel::ibge()->cities()->get('Acre');
    expect($cities)
        ->toBeInstanceOf(Collection::class)
        ->and($cities->first())
        ->toBeInstanceOf(CityDTO::class);
});

it('should not be able to get cities from an invalid state', function () {
    $cities = BrasilapiLaravel::ibge()->cities()->get('invalid');
    expect($cities)
        ->toBeNull();
});
