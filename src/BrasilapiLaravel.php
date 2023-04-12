<?php

declare(strict_types=1);

namespace BrasilapiLaravel;

use BrasilapiLaravel\Endpoints\Traits\HasBanks;
use BrasilapiLaravel\Endpoints\Traits\HasBrokers;
use BrasilapiLaravel\Endpoints\Traits\HasCep;
use BrasilapiLaravel\Endpoints\Traits\HasIBGE;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BrasilapiLaravel
{
    use HasCep;
    use HasIBGE;
    use HasBanks;
    use HasBrokers;

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
