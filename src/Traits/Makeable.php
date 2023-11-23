<?php

namespace Waad\ZainCash\Traits;

trait Makeable
{
    /**
     * @param mixed ...$args
     */
    public static function make(...$args): static
    {
        return new static(...$args);
    }
}
