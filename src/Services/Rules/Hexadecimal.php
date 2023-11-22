<?php

namespace Waad\ZainCash\Services\Rules;

use Illuminate\Contracts\Validation\Rule;

class Hexadecimal implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value is a valid hexadecimal string
        return preg_match('/^[0-9a-fA-F]+$/', $value);
    }

    public function message()
    {
        return trans('zaincash::zaincash.id_hexadecimal', ['attribute' => 'id'], config("zaincash.language", "ar"));
    }
}
