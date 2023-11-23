<?php

namespace Waad\ZainCash;

use Waad\ZainCash\Traits\getSetAttributes;
use Waad\ZainCash\Traits\HttpClientRequests;
use Waad\ZainCash\Traits\Initialable;

abstract class BaseZainCash
{
    use Initialable;
    use getSetAttributes;
    use HttpClientRequests;

    public function __construct(
        protected $amount = null,
        protected $minAmount = null,
        protected $serviceType = null,
        protected $orderId = null,
        protected $msisdn = null,
        protected $secret = null,
        protected $merchantId = null,
        protected $isTest = null,
        protected $language = null,
        protected $baseUrl = null,
        protected $isRedirect = null,
        protected $tUrl = null,
        protected $cUrl = null,
        protected $rUrl = null,
        protected $processingUrl = null,
        protected $processingOtpUrl = null,
        protected $cancelUrl = null,
        protected $transactionID = null,
        protected $isReturnArray = false,
        protected $timeout = null,
        protected $verifySsl = null
    ) {
        if ($orderId) {
            $this->orderId = $this->getConfig("prefix_order_id") . $orderId;
        }

        $this->initial();
    }

    protected function bodyPostRequest($token, $language, $merchantId)
    {
        return [
            'lang' => $language, 
            ...$this->bodyPostRequestCheckTransaction($token, $merchantId)
        ];
    }

    protected function bodyPostRequestCheckTransaction($token, $merchantId)
    {
        return [
            'merchantId' => $merchantId,
            'token' => urlencode($token),
        ];
    }

    protected function createToken($amount, $serviceType, $msisdn, $orderId, $redirectUrl, $secret)
    {
        $data = [
            "amount" => $amount,
            "serviceType" => $serviceType,
            "msisdn" => $msisdn,
            "orderId" => $orderId,
            "redirectUrl" => $redirectUrl,
            "iat" => time(),
            "exp" => time() + 60 * 60 * 4,
        ];

        return app(\Waad\ZainCash\Services\JWT::class)->encode($data, $secret);
    }

    protected function createTokenCheck(string $transactionID, string $msisdn, string $secret)
    {
        $data = [
            "id" => $transactionID,
            "msisdn" => $msisdn,
            "iat" => time(),
            "exp" => time() + 60 * 60 * 4,
        ];

        return app(\Waad\ZainCash\Services\JWT::class)->encode($data, $secret);
    }

    protected function getConfig(string $arrtibute, string $default = null)
    {
        return config("zaincash.$arrtibute", $default);
    }

    protected function jsonDecodeObject($array, $isReturnArray = false)
    {
        return json_decode(json_encode($array), $isReturnArray);
    }

    protected function getCheckResponseId($parseResponse)
    {
        if (blank($parseResponse->id ?? null)) {
            throw new \Exception($parseResponse->err->msg);
        }
    }
}
