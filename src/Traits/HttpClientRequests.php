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
                $this->getTUrl(),
                $body,
                [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                $this->getTimeout(),
                $this->getVerifySsl()
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
                $this->getCUrl(),
                $body,
                [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                $this->getTimeout(),
                $this->getVerifySsl()
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
                $this->getProcessingUrl(),
                [
                    'id' => $this->getTransactionID(),
                    'phonenumber' => $phonenumber,
                    'pin' => $pin,
                ],
                [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                $this->getTimeout(),
                $this->getVerifySsl()
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
                $this->getProcessingOtpUrl(),
                [
                    'id' => $this->getTransactionID(),
                    'phonenumber' => $phonenumber,
                    'pin' => $pin,
                    'otp' => $otp,
                ],
                [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                $this->getTimeout(),
                $this->getVerifySsl()
            );
    }

    /**
     * @return @return \Psr\Http\Message\ResponseInterface|\Illuminate\Http\Client\Response|array
     */
    protected function sendRequestCancelTransaction()
    {
        return app(\Waad\ZainCash\Services\HttpClient::class)
            ->httpPost(
                $this->getCancelUrl(),
                [
                    'id' => $this->getTransactionID(),
                    'type' => 'MERCHANT_PAYMENT'
                ],
                [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                $this->getTimeout(),
                $this->getVerifySsl()
            );
    }
}
