<?php

namespace Waad\ZainCash\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class HttpClient
{
    /**
     * @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    public function httpPost(string $url, array $data = [], array $headers = []): mixed
    {
        try {
            $response = Http::timeout(10)->withHeaders($headers)->asForm()->post($url, $data);
            return $response;
        } catch (RequestException $e) {
            return [
                'error' => $e->getMessage(),
                'status' => $e->response->status(),
            ];
        }
    }
}
