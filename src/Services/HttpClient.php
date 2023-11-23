<?php

namespace Waad\ZainCash\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Client\RequestException;

class HttpClient
{
    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    public function httpPost(string $url, array $data = [], array $headers = [], int $timeout = 10)
    {
        set_time_limit($timeout);

        try {

            $client = new Client([
                'timeout' => $timeout,
            ]);

            $response = $client->post($url, [
                'headers' => $headers,
                'form_params' => $data
            ]);

            return $response;
        } catch (RequestException $e) {
            return [
                'error' => $e->getMessage(),
                'status' => $e->response->status(),
            ];
        }
    }
}
