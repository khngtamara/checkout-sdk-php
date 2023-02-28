<?php

namespace Checkout\Tamara;

use Checkout\Tamara\CheckoutException;

class CheckoutArgumentException extends CheckoutException
{

    public function __construct($message)
    {
        parent::__construct($message);
    }

}
