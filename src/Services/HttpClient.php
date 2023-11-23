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
     * @param int $timeout
     * @param bool $verify
     * @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    public function httpPost(string $url, array $data = [], array $headers = [], int $timeout = 10, bool $verify = false)
    {
        set_time_limit($timeout);

        try {

            $client = new Client([
                'timeout' => $timeout,
                'verify' => $verify,
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
