<?php

namespace Checkout\Tamara;

use Checkout\Tamara\CheckoutSdkBuilder;

class CheckoutSdk
{
    public static function builder()
    {
        return new CheckoutSdkBuilder();
    }
}
