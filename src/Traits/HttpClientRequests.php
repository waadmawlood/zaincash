<?php

namespace Waad\ZainCash\Traits;

trait HttpClientRequests
{
    /**
     * @param string $token
     * @return @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    protected function createTransactionHttpClient(string $token)
    {
        $body = $this->bodyPostRequest($token, $this->getLanguage(), $this->getMerchantId());

        return app(\Waad\ZainCash\Services\HttpClient::class)
            ->httpPost(
                url: $this->getTUrl(),
                data: $body,
                timeout: $this->getTimeout()
            );
    }

    /**
     * @param string $token
     * @return @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    protected function sendRequestCheckTransaction(string $token)
    {
        $body = $this->bodyPostRequestCheckTransaction($token, $this->getMerchantId());
        return app(\Waad\ZainCash\Services\HttpClient::class)
            ->httpPost(
                url: $this->getCUrl(),
                data: $body,
                timeout: $this->getTimeout()
            );
    }

    /**
     * @param string $phonenumber
     * @param string $pin
     * @return @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    protected function sendRequestProcessingTransaction(string $phonenumber, string $pin)
    {
        return app(\Waad\ZainCash\Services\HttpClient::class)
            ->httpPost(
                url: $this->getProcessingUrl(),
                data: [
                    'id' => $this->getTransactionID(),
                    'phonenumber' => $phonenumber,
                    'pin' => $pin,
                ],
                timeout: $this->getTimeout()
            );
    }

    /**
     * @param string $phonenumber
     * @param string $pin
     * @param string $otp
     * @return @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    protected function sendRequestPayTransaction(string $phonenumber, string $pin, string $otp)
    {
        return app(\Waad\ZainCash\Services\HttpClient::class)
            ->httpPost(
                url: $this->getProcessingOtpUrl(),
                data: [
                    'id' => $this->getTransactionID(),
                    'phonenumber' => $phonenumber,
                    'pin' => $pin,
                    'otp' => $otp,
                ],
                timeout: $this->getTimeout()
            );
    }

    /**
     * @return @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    protected function sendRequestCancelTransaction()
    {
        return app(\Waad\ZainCash\Services\HttpClient::class)
            ->httpPost(
                url: $this->getCancelUrl(),
                data: [
                    'id' => $this->getTransactionID(),
                    'type' => 'MERCHANT_PAYMENT'
                ],
                timeout: $this->getTimeout()
            );
    }
}
