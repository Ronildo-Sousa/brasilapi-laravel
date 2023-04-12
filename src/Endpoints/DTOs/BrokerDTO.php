<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\DTOs;

class BrokerDTO
{
    public readonly string $cnpj;

    public readonly string $type;

    public readonly string $social_name;

    public readonly string $commercial_name;

    public readonly string $status;

    public readonly string $email;

    public readonly string $phone;

    public readonly string $cep;

    public readonly string $country;

    public readonly string $state;

    public readonly string $city;

    public readonly string $neighborhood;

    public readonly string $street;

    public readonly string $complement;

    public readonly string $net_worth_date;

    public readonly string $net_worth_amount;

    public readonly string $cvm_code;

    public readonly string $intial_date;

    public readonly string $register_date;

    public function __construct(array $data)
    {
        $this->cnpj = data_get($data, 'cnpj');
        $this->type = data_get($data, 'type');
        $this->social_name = data_get($data, 'nome_social');
        $this->commercial_name = data_get($data, 'nome_comercial');
        $this->status = data_get($data, 'status');
        $this->email = data_get($data, 'email');
        $this->phone = data_get($data, 'telefone');
        $this->cep = data_get($data, 'cep');
        $this->country = data_get($data, 'pais');
        $this->state = data_get($data, 'uf');
        $this->city = data_get($data, 'municipio');
        $this->neighborhood = data_get($data, 'bairro');
        $this->street = data_get($data, 'logradouro');
        $this->complement = data_get($data, 'complemento');
        $this->net_worth_date = data_get($data, 'data_patrimonio_liquido');
        $this->net_worth_amount = data_get($data, 'valor_patrimonio_liquido');
        $this->cvm_code = data_get($data, 'codigo_cvm');
        $this->intial_date = data_get($data, 'data_inicio_situacao');
        $this->register_date = data_get($data, 'data_registro');
    }
}
