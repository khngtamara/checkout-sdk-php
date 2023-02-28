<?php

namespace Checkout\Tamara\Previous;

use Checkout\Tamara\Previous\CheckoutStaticKeysPreviousSdkBuilder;

class CheckoutPreviousSdkBuilder
{

    public function staticKeys()
    {
        return new CheckoutStaticKeysPreviousSdkBuilder();
    }

}
