<?php

namespace Waad\ZainCash;

use GuzzleHttp\Exception\RequestException;
use Waad\ZainCash\Traits\Makeable;

class ZainCash extends BaseZainCash
{
    use Makeable;

    /**
     * Create Request Transaction
     *
     * @throws RequestException
     * @return array|\stdClass|\Illuminate\Http\RedirectResponse
     */
    public function createTransaction()
    {
        // Validation Create Step
        $this->validationCreateRequest();

        // Create Token JWT
        $token = $this->createToken(
            $this->getAmount(),
            $this->getServiceType(),
            $this->getMsisdn(),
            $this->getOrderId(),
            $this->getIsRedirect() ? $this->getRUrl() : '',
            $this->getSecret()
        );

        // Creates a transaction HTTP client using the provided token.
        $response = $this->createTransactionHttpClient($token);

        // Check if the response is not 200
        if ($response->getStatusCode() !== 200) {
            throw RequestException::create($response);
        }

        // Parse the response to Object StdClass
        $parseResponse = json_decode($response->getBody()->getContents());

        // Check if the response has error
        $this->getCheckResponseId($parseResponse);
        $transactionID = $parseResponse->id;

        // Redirect to ZainCash payment page or return transaction id
        return $this->getIsRedirect() ?
            redirect()->away($this->getRUrl() . $transactionID) :
            ($this->getIsReturnArray() ?
                json_decode(json_encode($parseResponse), true) :
                $parseResponse);
    }

    /**
     * Check Transaction ID
     *
     * @throws RequestException
     * @return array|\stdClass
     */
    public function checkTransaction()
    {
        // Create Token JWT
        $token = $this->createTokenCheck(
            $this->getTransactionId(),
            $this->getMsisdn(),
            $this->getSecret()
        );

        // Check Transaction HTTP client using the provided token.
        $response = $this->sendRequestCheckTransaction($token);

        // Check if the response is not success
        if ($response->getStatusCode() !== 200) {
            throw RequestException::create($response);
        }

        // Parse the response to Object StdClass or Array
        $parseResponse = json_decode($response->getBody()->getContents(), $this->getIsReturnArray());

        return $parseResponse;
    }


    /**
     * Processing Transaction
     *
     * @param string $phonenumber
     * @param string $pin
     * @param string|null $transactionID
     * @throws RequestException
     * @return array|\stdClass
     */
    public function processingTransaction(string $phonenumber, string $pin, $transactionID = null)
    {
        // Set Transaction ID if not set
        if (blank($this->getTransactionID())) {
            $this->setTransactionID($transactionID);
        }

        // Validation Processing Step
        $this->validationProcessing($phonenumber, $pin);

        // Processing Transaction HTTP client using the provided phone number and pin.
        $response = $this->sendRequestProcessingTransaction($phonenumber, $pin);

        // Check if the response is not success
        if ($response->getStatusCode() !== 200) {
            throw RequestException::create($response);
        }

        // Parse the response to Object StdClass or Array
        $parseResponse = json_decode($response->getBody()->getContents(), $this->getIsReturnArray());

        return $parseResponse;
    }


    /**
     * Pay Transaction
     *
     * @param string $phonenumber
     * @param string $pin
     * @param string $otp
     * @param string|null $transactionID
     * @throws RequestException
     * @return array|\stdClass
     */
    public function payTransaction($phonenumber, $pin, $otp, $transactionID = null)
    {
        // Set Transaction ID if not set
        if (blank($this->getTransactionID())) {
            $this->setTransactionID($transactionID);
        }

        // Validation Processing OTP Step
        $this->validationProcessingOtp($phonenumber, $pin, $otp);

        // Pay Transaction HTTP client using the provided phone number, pin and otp.
        $response = $this->sendRequestPayTransaction($phonenumber, $pin, $otp);

        // Check if the response is not success
        if ($response->getStatusCode() !== 200) {
            throw RequestException::create($response);
        }

        // Parse the response to Object StdClass or Array
        $parseResponse =  json_decode($response->getBody()->getContents(), $this->getIsReturnArray());

        return $parseResponse;
    }

    /**
     * Cancel Transaction
     *
     * @param string|null $transactionID
     * @throws RequestException
     * @return array|\stdClass
     */
    public function cancelTransaction($transactionID = null)
    {
        // Set Transaction ID if not set
        if (blank($this->getTransactionID())) {
            $this->setTransactionID($transactionID);
        }

        // Cancel Transaction HTTP client using the provided transaction id.
        $response = $this->sendRequestCancelTransaction();

        // Check if the response is not success
        if ($response->getStatusCode() !== 200) {
            throw RequestException::create($response);
        }

        // Parse the response to Object StdClass or Array
        $parseResponse =  json_decode($response->getBody()->getContents(), $this->getIsReturnArray());

        return $parseResponse;
    }
}
