<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    public static function token()
    {
        return session('api_token');    // guarda/recupera token
    }

    public static function client()
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.self::token(),
        ])->baseUrl(config('services.backend.url', 'http://backend:8000/api'));
    }
}
