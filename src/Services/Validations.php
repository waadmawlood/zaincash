<?php

namespace Waad\ZainCash\Services;

use Illuminate\Support\Facades\Validator;

class Validations
{
    private $minAmount;
    private $lang;

    /**
     * @param float $amount
     * @param string $msisdn
     * @param string $serviceType
     * @param string $orderId
     * @param string|null $lang
     * @param float|null $minAmount
     */
    public function validator($amount, $msisdn, $serviceType, $orderId, $lang = null, $minAmount = null): mixed
    {

        $this->lang = $lang;
        if (blank($lang))
            $this->lang = config("zaincash.language", "ar");

        $this->minAmount = $minAmount;
        if (is_null($minAmount))
            $this->minAmount = config("zaincash.min_amount", 1000);

        $validator = Validator::make([
            "amount" => $amount,
            "msisdn" => $msisdn,
            "serviceType" => $serviceType,
            "orderId" => $orderId,
        ], $this->validationRules(), $this->validationMessages());

        if ($validator->fails()) {
            return $this->prepareOutput(true, $validator->errors()->first());
        }

        return $this->prepareOutput(false);
    }

    private function validationRules(): array
    {
        return [
            "amount" => ["required", "numeric", "min:{$this->minAmount}"],
            "msisdn" => ["required", "regex:/^[0-9]{13}$/"],
            "serviceType" => ["required", "string", "max:254"],
            "orderId" => ["required", "string", "max:512"],
        ];
    }

    private function validationMessages(): array
    {
        return [
            "amount.required" => trans('zaincash::zaincash.amount_required', [], $this->lang),
            "amount.numeric" => trans('zaincash::zaincash.amount_numeric', [], $this->lang),
            "amount.min" => trans('zaincash::zaincash.amount_min', ['min' => $this->minAmount], $this->lang),
            "msisdn.regex" => trans('zaincash::zaincash.msisdn_regex', [], $this->lang),
            "serviceType.required" => trans('zaincash::zaincash.serviceType_required', [], $this->lang),
            "serviceType.max" => trans('zaincash::zaincash.serviceType_max', [], $this->lang),
            "orderId.required" => trans('zaincash::zaincash.orderId_required', [], $this->lang),
            "orderId.max" => trans('zaincash::zaincash.orderId_max', [], $this->lang),
        ];
    }

    private function prepareOutput(bool $isError, string $message = "Successfull"): mixed
    {
        return json_decode(json_encode(["error" => $isError, "message" => $message]), false);
    }
}
