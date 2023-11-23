<?php

namespace Waad\ZainCash\Services;

/**
 * JWT Service
 * @package waad/zaincash
 */
class JWT
{
    /**
     * Encode a JWT
     */
    public function encode(array $data, string $secret, string $alg = 'HS256'): string
    {
        // Encode the header
        $header = json_encode(['typ' => 'JWT', 'alg' => $alg]);

        // Encode the payload
        $payload = json_encode($data);

        // Base64 encode the header and payload
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create the signature
        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, $secret, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Combine the encoded header, payload, and signature with periods
        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

        return $jwt;
    }
}
