<?php

namespace Waad\ZainCash\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @package waad\zaincash
 */
class ZainCash extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'waad-zaincash';
    }
}
