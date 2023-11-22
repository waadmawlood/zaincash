<?php

namespace Waad\ZainCash\Traits;

trait Makeable
{
    /**
     * @param mixed ...$args
     * @return static
     */
    public static function make(...$args)
    {
        return new static(...$args);
    }
}
