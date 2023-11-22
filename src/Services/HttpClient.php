<?php

namespace Waad\ZainCash\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HttpClient
{
    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return \Psr\Http\Message\ResponseInterface|array
     */
    public function httpPost(string $url, array $data = [], array $headers = [])
    {
        try {

            $client = new Client();

            $response = $client->post($url, [
                'headers' => $headers,
                'form_params' => $data
            ]);

            return $response;
        } catch (RequestException $e) {
            return [
                'error' => $e->getMessage(),
                'status' => $e->getResponse()->getStatusCode(),
            ];
        }
    }
}
