<?php

declare(strict_types=1);

use BrasilApi\BrasilapiLaravel\Endpoints\Brokers\BrokerDTO;
use BrasilApi\BrasilapiLaravel\Facades\BrasilapiLaravel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake([
        config('brasilapi-laravel.base_url').'/cvm/corretoras/'.config('brasilapi-laravel.version') => Http::response([
            [
                'cnpj' => '76621457000185',
                'type' => 'CORRETORAS',
                'nome_social' => '4UM DTVM S.A.',
                'nome_comercial' => '4UM INVESTIMENTOS',
                'status' => 'CANCELADA',
                'email' => 'controle@4um.com.br',
                'telefone' => '33519966',
                'cep' => '80420210',
                'pais' => 'BRASIL',
                'uf' => 'PR',
                'municipio' => 'CURITIBA',
                'bairro' => 'CENTRO',
                'complemento' => '4º ANDAR',
                'logradouro' => 'R. VISCONDE DO RIO BRANCO 1488',
                'data_patrimonio_liquido' => '2005-12-31',
                'valor_patrimonio_liquido' => '4228660.18',
                'codigo_cvm' => '2275',
                'data_inicio_situacao' => '2006-10-05',
                'data_registro' => '1968-01-15',
            ],
            [
                'cnpj' => '33817677000176',
                'type' => 'CORRETORAS',
                'nome_social' => 'ABC BRASIL DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A.',
                'nome_comercial' => 'ABC BRASIL CORRETORA',
                'status' => 'CANCELADA',
                'email' => 'regina.tkatch@abcbrasil.com.br',
                'telefone' => '31702172',
                'cep' => '1453000',
                'pais' => '',
                'uf' => 'SP',
                'municipio' => 'SÃO PAULO',
                'bairro' => 'ITAIM BIBI',
                'complemento' => '2º ANDAR',
                'logradouro' => 'AV. CIDADE JARDIM, 803',
                'data_patrimonio_liquido' => '2002-12-31',
                'valor_patrimonio_liquido' => '0.00',
                'codigo_cvm' => '3514',
                'data_inicio_situacao' => '2002-10-14',
                'data_registro' => '2002-10-14',
            ],
        ]),
    ]);
    Http::fake([
        config('brasilapi-laravel.base_url').'/cvm/corretoras/'.config('brasilapi-laravel.version').'/*' => Http::response(
            [
                'cnpj' => '76621457000185',
                'type' => 'CORRETORAS',
                'nome_social' => '4UM DTVM S.A.',
                'nome_comercial' => '4UM INVESTIMENTOS',
                'status' => 'CANCELADA',
                'email' => 'controle@4um.com.br',
                'telefone' => '33519966',
                'cep' => '80420210',
                'pais' => 'BRASIL',
                'uf' => 'PR',
                'municipio' => 'CURITIBA',
                'bairro' => 'CENTRO',
                'complemento' => '4º ANDAR',
                'logradouro' => 'R. VISCONDE DO RIO BRANCO 1488',
                'data_patrimonio_liquido' => '2005-12-31',
                'valor_patrimonio_liquido' => '4228660.18',
                'codigo_cvm' => '2275',
                'data_inicio_situacao' => '2006-10-05',
                'data_registro' => '1968-01-15',
            ],
        ),
    ]);
});

it('should be able to get a list of brokers from CVM', function () {
    $brokers = BrasilapiLaravel::brokers()->get();
    $firstBroker = $brokers->first();

    expect($brokers)
        ->toBeInstanceOf(Collection::class)
        ->and($firstBroker)
        ->toBeInstanceOf(BrokerDTO::class)
        ->and($brokers->last())
        ->toBeInstanceOf(BrokerDTO::class);
});

it('should be able to get a single broker from CVM', function () {
    $broker = BrasilapiLaravel::brokers()->find('76621457000185');

    expect($broker)
        ->toBeInstanceOf(BrokerDTO::class)
        ->and($broker->social_name)
        ->toBe('4UM DTVM S.A.')
        ->and($broker->commercial_name)
        ->toBe('4UM INVESTIMENTOS')
        ->and($broker->cvm_code)
        ->toBe('2275');
});
