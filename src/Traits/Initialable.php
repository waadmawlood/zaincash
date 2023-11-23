<?php

namespace Waad\ZainCash\Traits;

trait Initialable
{
    /**
     * @param bool|null $checkTransaction
     * @throws \Exception
     * @return void
     */
    protected function initial()
    {
        // Set the isTest
        if (is_null($this->getIsTest())) {
            $this->setIsTest($this->getConfig("test"));
        }

        // Set the Min Amount.
        if (is_null($this->getMinAmount())) {
            $this->setMinAmount($this->getConfig("min_amount"));
        }

        // Set the MSISDN.
        if (blank($this->getMsisdn())) {
            $this->setMsisdn($this->getConfig("msisdn"));
        }

        // Set the secret.
        if (blank($this->getSecret())) {
            $this->setSecret($this->getConfig("secret"));
        }

        // Set the merchant ID.
        if (blank($this->getMerchantId())) {
            $this->setMerchantId($this->getConfig("merchant_id"));
        }

        // Set the language.
        if (blank($this->getLanguage())) {
            $this->setLanguage($this->getConfig("language"));
        }

        // Set the redirection status.
        if (is_null($this->getIsRedirect())) {
            $this->setIsRedirect($this->getConfig("is_redirect"));
        }

        // Set the timeout request.
        if (is_null($this->getTimeout())) {
            $this->setTimeout($this->getConfig("timeout"));
        }

        // Set the verify SSL.
        if (is_null($this->getVerifySsl())) {
            $this->setVerifySsl($this->getConfig("verify_ssl"));
        }

        // Set the URLs.
        $this->initailUrls();
    }

    protected function initailUrls(bool $force = false)
    {
        // Set the base URL.
        if (($this->getIsTest() && blank($this->getBaseUrl())) || ($this->getIsTest() && $force)) {
            $this->setBaseUrl($this->getConfig("test_url"));
        } 
        
        if ((!$this->getIsTest() && blank($this->getBaseUrl())) || (!$this->getIsTest() && $force)) {
            $this->setBaseUrl($this->getConfig("live_url"));
        }

        // Add a trailing slash to the base URL if it is not already present.
        if (filled($this->getBaseUrl()) && substr($this->getBaseUrl(), -1) !== "/") {
            $this->setBaseUrl($this->getBaseUrl() . "/");
        }

        // Set the URLs.
        if ($force || blank($this->getTUrl())) $this->setTUrl($this->getBaseUrl() . "transaction/init");
        if ($force || blank($this->getCUrl())) $this->setCUrl($this->getBaseUrl() . "transaction/get");
        if ($force || blank($this->getRUrl())) $this->setRUrl($this->getBaseUrl() . "transaction/pay?id=");
        if ($force || blank($this->getProcessingUrl())) $this->setProcessingUrl($this->getBaseUrl() . "transaction/processing");
        if ($force || blank($this->getProcessingOtpUrl())) $this->setProcessingOtpUrl($this->getBaseUrl() . "transaction/processingOTP?type=MERCHANT_PAYMENT");
        if ($force || blank($this->getCancelUrl())) $this->setCancelUrl($this->getBaseUrl() . "transaction/cancel");
    }

    /**
     * Validation Create Request
     *
     * @throws \Exception
     * @return void
     */
    public function validationCreateRequest()
    {
        $validator = app(\Waad\ZainCash\Services\Validations::class)->validator(
            $this->getAmount(),
            $this->getMsisdn(),
            $this->getServiceType(),
            $this->getOrderId(),
            $this->getLanguage(),
            $this->getMinAmount()
        );

        if ($validator->error) {
            throw new \Exception($validator->message);
        }
    }

    /**
     * Validation Processing Step
     *
     * @param string $phonenumber
     * @param string $pin
     * @throws \Exception
     * @return void
     */
    public function validationProcessing(string $phonenumber, string $pin)
    {
        $validator = app(\Waad\ZainCash\Services\ValidationProcessing::class)->validator(
            $this->getTransactionID(),
            $phonenumber,
            $pin,
            $this->getLanguage()
        );

        if ($validator->error) {
            throw new \Exception($validator->message);
        }
    }

    /**
     * Validation Processing OTP Step
     *
     * @param string $phonenumber
     * @param string $pin
     * @param string $otp
     * @throws \Exception
     * @return void
     */
    public function validationProcessingOtp(string $phonenumber, string $pin, string $otp)
    {
        $validator = app(\Waad\ZainCash\Services\ValidationProcessingOtp::class)->validator(
            $this->getTransactionID(),
            $phonenumber,
            $pin,
            $otp,
            $this->getLanguage()
        );

        if ($validator->error) {
            throw new \Exception($validator->message);
        }
    }
}
