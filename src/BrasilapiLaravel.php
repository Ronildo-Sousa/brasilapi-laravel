<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel;

use BrasilApi\BrasilapiLaravel\Endpoints\Banks\HasBanks;
use BrasilApi\BrasilapiLaravel\Endpoints\CEP\HasCep;
use BrasilApi\BrasilapiLaravel\Endpoints\IBGE\HasIBGE;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BrasilapiLaravel
{
    use HasCep;
    use HasIBGE;
    use HasBanks;

    public PendingRequest $api;

    public string $version;

    public function __construct()
    {
        $this->version = config('brasilapi-laravel.version');

        $this->api = Http::withHeaders([
            'Accept' => 'application/json',
        ])->baseUrl(config('brasilapi-laravel.base_url'));
    }
}
