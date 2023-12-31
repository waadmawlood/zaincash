<?php

namespace Waad\ZainCash\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class HttpClient
{
    /**
     * @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    public function httpPost(string $url, array $data = [], array $headers = [], int $timeout = 10, bool $verify = false): mixed
    {
        set_time_limit($timeout);
        
        try {
            $response = Http::timeout($timeout)->withHeaders($headers)->withOptions(['verify' => $verify])->asForm()->post($url, $data);
            return $response;
        } catch (RequestException $e) {
            return [
                'error' => $e->getMessage(),
                'status' => $e->response->status(),
            ];
        }
    }
}
