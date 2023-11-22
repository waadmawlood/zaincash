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

    protected $amount;
    protected $minAmount;
    protected $serviceType;
    protected $orderId;
    protected $msisdn;
    protected $secret;
    protected $merchantId;
    protected $isTest;
    protected $language;
    protected $baseUrl;
    protected $isRedirect;
    protected $tUrl;
    protected $cUrl;
    protected $rUrl;
    protected $processingUrl;
    protected $processingOtpUrl;
    protected $cancelUrl;
    protected $transactionID;
    protected $isReturnArray = false;

    public function __construct(
        $amount = null,
        $serviceType = null,
        $orderId = null,
        $msisdn = null,
        $secret = null,
        $merchantId = null,
        $isTest = null,
        $language = null,
        $baseUrl = null
    ) {
        $this->amount = $amount;
        $this->serviceType = $serviceType;

        if($orderId) {
            $this->orderId = $this->getConfig("prefix_order_id") . $orderId;
        }

        $this->msisdn = $msisdn;
        $this->secret = $secret;
        $this->merchantId = $merchantId;
        $this->isTest = $isTest;
        $this->language = $language;
        $this->baseUrl = $baseUrl;

        $this->initial();
    }

    protected function bodyPostRequest($token, $language, $merchantId)
    {
        return [
            'lang' => $language,
            'merchantId' => $merchantId,
            'token' => urlencode($token),
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

    protected function createTokenCheck($transactionID, $msisdn, $secret)
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

    protected function jsonDecodeObject($array)
    {
        return json_decode(json_encode($array), FALSE);
    }

    protected function getCheckResponseId($parseResponse)
    {
        if (!isset($parseResponse->id)) {
            throw new \Exception($parseResponse->err->msg);
        }
    }
}
