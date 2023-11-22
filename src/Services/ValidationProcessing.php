<?php

namespace Waad\ZainCash\Services;

use Illuminate\Support\Facades\Validator;
use Waad\ZainCash\Services\Rules\Hexadecimal;

class ValidationProcessing
{
    private $lang;

    /**
     * @param string $transactionID
     * @param string $phonenumber
     * @param string $pin
     * @param string|null $lang
     */
    public function validator($transactionID, $phonenumber, $pin, $lang = null): mixed
    {
        $this->lang = $lang;
        if (blank($lang))
            $this->lang = config("zaincash.language", "ar");

        $validator = Validator::make([
            "id" => $transactionID,
            "phonenumber" => $phonenumber,
            "pin" => $pin,
        ], $this->validationRules(), $this->validationMessages());

        if ($validator->fails()) {
            return $this->prepareOutput(true, $validator->errors()->first());
        }

        return $this->prepareOutput(false);
    }

    private function validationRules(): array
    {
        return [
            "id" => ["required", new Hexadecimal],
            "phonenumber" => ["required", "regex:/^[0-9]{13}$/"],
            "pin" => ["required", "string", "max:254"],
        ];
    }

    private function validationMessages(): array
    {
        return [
            "id.required" => trans('zaincash::zaincash.id_required', [], $this->lang),
            "phonenumber.required" => trans('zaincash::zaincash.phonenumber_required', [], $this->lang),
            "phonenumber.regex" => trans('zaincash::zaincash.phonenumber_regex', [], $this->lang),
            "pin.required" => trans('zaincash::zaincash.pin_required', [], $this->lang),
            "pin.max" => trans('zaincash::zaincash.pin_max', [], $this->lang),
        ];
    }

    private function prepareOutput(bool $isError, string $message = "Successfull"): mixed
    {
        return json_decode(json_encode(["error" => $isError, "message" => $message]), false);
    }
}
