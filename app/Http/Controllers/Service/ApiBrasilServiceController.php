<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\ApiBrasilService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class ApiBrasilServiceController extends Controller
{
    public function __construct()
    {
        $hasToken = ApiBrasilService::first();

        if (!$hasToken) {
            $headers = [
                'Content-Type' => 'application/json',
            ];

            $body = [
                "email" => env('API_BRASIL_EMAIL'),
                "password" => env('API_BRASIL_PASSWORD'),
            ];

            $response = Http::withHeaders($headers)->post(env('API_BRASIL_URL') . '/api/v1/login', $body);
            $data = ApiBrasilService::create([
                'token' => $response['authorization']['token'],
                'expires_in' => $response['authorization']['expires_in']
            ]);

            return response([
                'token' => $data->token,
                'expires_in' => Carbon::parse($data->expires_in)->format('d/m/Y H:i:s')
            ], 200);
        }
    }

    public function vehicles(Request $request)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'SecretKey' => env('API_BRASIL_SECRET_KEY'),
            'PublicToken' => env('API_BRASIL_PUBLIC_TOKEN'),
            'DeviceToken' => env('API_BRASIL_DEVICE_TOKEN'),
        ];

        $body = [
            "placa" => $request->placa,
        ];

        $hasToken = ApiBrasilService::first();

        $response = Http::withToken($hasToken->token)
            ->withHeaders($headers)
            ->post(env('API_BRASIL_URL').'/api/v1/vehicles/dados', $body);

        return response($response->json(), 200);
    }
}
