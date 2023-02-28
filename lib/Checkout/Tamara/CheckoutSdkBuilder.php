<?php

namespace Checkout\Tamara;

use Checkout\Tamara\Previous\CheckoutPreviousSdkBuilder;
use Checkout\Tamara\CheckoutOAuthSdkBuilder;
use Checkout\Tamara\CheckoutStaticKeysSdkBuilder;

class CheckoutSdkBuilder
{

    /**
     * @return \Checkout\Tamara\Previous\CheckoutPreviousSdkBuilder
     */
    public function previous()
    {
        return new CheckoutPreviousSdkBuilder();
    }

    /**
     * @return CheckoutStaticKeysSdkBuilder
     */
    public function staticKeys()
    {
        return new CheckoutStaticKeysSdkBuilder();
    }

    /**
     * @return CheckoutOAuthSdkBuilder
     */
    public function oAuth()
    {
        return new CheckoutOAuthSdkBuilder();
    }
}
