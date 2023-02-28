<?php

namespace Checkout\Tamara;

use Checkout\Tamara\CheckoutException;

class CheckoutFileException extends CheckoutException
{

    public function __construct($message)
    {
        parent::__construct($message);
    }

}
