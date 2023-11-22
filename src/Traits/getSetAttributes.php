<?php

namespace Waad\ZainCash\Traits;

trait getSetAttributes
{
    /**
     * @return int|float|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int|float $amount
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int|float|null
     */
    public function getMinAmount()
    {
        return $this->minAmount;
    }

    /**
     * @param int|float $minAmount 
     * @return self
     */
    public function setMinAmount($minAmount)
    {
        $this->minAmount = $minAmount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * @param string $serviceType
     * @return self
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @return string|int|float|null
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string|int|float $orderId
     * @return self
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $this->getConfig("prefix_order_id") . $orderId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param string $msisdn
     * @return self
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return self
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     * @return self
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsTest()
    {
        return $this->isTest;
    }

    /**
     * @param bool $isTest
     * @return self
     */
    public function setIsTest($isTest)
    {
        $this->isTest = $isTest;
        $this->initailUrls(true);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     * @return self
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsRedirect()
    {
        return $this->isRedirect;
    }

    /**
     * @param bool  $isRedirect
     * @return self
     */
    public function setIsRedirect($isRedirect)
    {
        $this->isRedirect = $isRedirect;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTUrl()
    {
        return $this->tUrl;
    }

    /**
     * @param string $tUrl
     * @return self
     */
    public function setTUrl($tUrl)
    {
        $this->tUrl = $tUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCUrl()
    {
        return $this->cUrl;
    }

    /**
     * @param string $cUrl
     * @return self
     */
    public function setCUrl($cUrl)
    {
        $this->cUrl = $cUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRUrl()
    {
        return $this->rUrl;
    }

    /**
     * @param string $rUrl
     * @return self
     */
    public function setRUrl($rUrl)
    {
        $this->rUrl = $rUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProcessingUrl()
    {
        return $this->processingUrl;
    }

    /**
     * @param string $processingUrl
     * @return self
     */
    public function setProcessingUrl($processingUrl)
    {
        $this->processingUrl = $processingUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProcessingOtpUrl()
    {
        return $this->processingOtpUrl;
    }

    /**
     * @param string $processingOtpUrl
     * @return self
     */
    public function setProcessingOtpUrl($processingOtpUrl)
    {
        $this->processingOtpUrl = $processingOtpUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * @param string $cancelUrl
     * @return self
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransactionID()
    {
        return $this->transactionID;
    }

    /**
     * @param string|null $transactionID
     * @return self
     */
    public function setTransactionID($transactionID = null)
    {
        $this->transactionID = $transactionID;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsReturnArray()
    {
        return $this->isReturnArray;
    }

    /**
     * @param bool $isReturnArray
     * @return self
     */
    public function setIsReturnArray($isReturnArray = false)
    {
        $this->isReturnArray = $isReturnArray;
        return $this;
    }
}
