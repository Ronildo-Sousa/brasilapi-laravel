<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel;

use BrasilApi\BrasilapiLaravel\Endpoints\CEP\HasCep;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BrasilapiLaravel
{
    use HasCep;

    public PendingRequest $api;

    public function __construct()
    {
        $this->api = Http::baseUrl(config('brasilapi-laravel.base_url'));
    }
}
