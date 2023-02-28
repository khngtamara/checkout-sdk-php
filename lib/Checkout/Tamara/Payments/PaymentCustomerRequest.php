<?php

namespace Checkout\Tamara\Payments;

use Checkout\Tamara\Common\CustomerRequest;

class PaymentCustomerRequest extends CustomerRequest
{
    /**
     * @var string
     */
    public $tax_number;
}
