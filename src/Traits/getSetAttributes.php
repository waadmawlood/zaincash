<?php

namespace Waad\ZainCash\Traits;

trait getSetAttributes
{
    public function getAmount(): int|float|null
    {
        return $this->amount;
    }

    public function setAmount(int|float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getMinAmount(): int|float|null
    {
        return $this->minAmount;
    }

    public function setMinAmount(int|float $minAmount): self
    {
        $this->minAmount = $minAmount;
        return $this;
    }

    public function getServiceType(): string|null
    {
        return $this->serviceType;
    }

    public function setServiceType(string $serviceType): self
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    public function getOrderId(): string|null
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): self
    {
        $this->orderId = $this->getConfig("prefix_order_id") . $orderId;
        return $this;
    }

    public function getMsisdn(): string|null
    {
        return $this->msisdn;
    }

    public function setMsisdn(string $msisdn): self
    {
        $this->msisdn = $msisdn;
        return $this;
    }

    public function getSecret(): string|null
    {
        return $this->secret;
    }

    public function setSecret(string $secret): self
    {
        $this->secret = $secret;
        return $this;
    }

    public function getMerchantId(): string|null
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): self
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function getIsTest(): bool|null
    {
        return $this->isTest;
    }

    public function setIsTest(bool $isTest): self
    {
        $this->isTest = $isTest;
        $this->initailUrls(true);
        return $this;
    }

    public function getLanguage(): string|null
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getBaseUrl(): string|null
    {
        return $this->baseUrl;
    }

    public function setBaseUrl($baseUrl): self
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function getIsRedirect(): bool|null
    {
        return $this->isRedirect;
    }

    public function setIsRedirect(bool $isRedirect): self
    {
        $this->isRedirect = $isRedirect;
        return $this;
    }

    public function getTUrl(): string|null
    {
        return $this->tUrl;
    }

    public function setTUrl(string $tUrl): self
    {
        $this->tUrl = $tUrl;
        return $this;
    }

    public function getCUrl(): string|null
    {
        return $this->cUrl;
    }

    public function setCUrl(string $cUrl): self
    {
        $this->cUrl = $cUrl;
        return $this;
    }

    public function getRUrl(): string|null
    {
        return $this->rUrl;
    }

    public function setRUrl(string $rUrl): self
    {
        $this->rUrl = $rUrl;
        return $this;
    }

    
    public function getProcessingUrl(): string|null
    {
        return $this->processingUrl;
    }

    public function setProcessingUrl(string $processingUrl): self
    {
        $this->processingUrl = $processingUrl;
        return $this;
    }

    
    public function getProcessingOtpUrl(): string|null
    {
        return $this->processingOtpUrl;
    }

    public function setProcessingOtpUrl(string $processingOtpUrl): self
    {
        $this->processingOtpUrl = $processingOtpUrl;
        return $this;
    }

    public function getCancelUrl(): string|null
    {
        return $this->cancelUrl;
    }

    public function setCancelUrl(string $cancelUrl): self
    {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    public function getTransactionID(): string|null
    {
        return $this->transactionID;
    }

    public function setTransactionID(?string $transactionID = null): self
    {
        $this->transactionID = $transactionID;
        return $this;
    }

    public function getIsReturnArray(): bool
    {
        return $this->isReturnArray;
    }

    public function setIsReturnArray(bool $isReturnArray = false): self
    {
        $this->isReturnArray = $isReturnArray;
        return $this;
    }

    public function getTimeout(): int|null
    {
        return $this->timeout;
    }

    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }
}
