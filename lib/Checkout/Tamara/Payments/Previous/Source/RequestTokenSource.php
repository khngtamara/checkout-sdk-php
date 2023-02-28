<?php

namespace Checkout\Tamara\Payments\Previous\Source;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Common\Phone;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;

class RequestTokenSource extends AbstractRequestSource
{

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$token);
    }

    /**
     * @var string
     */
    public $token;

    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $billing_address;

    /**
     * @var Phone
     */
    public $phone;

    /**
     * @var bool
     */
    public $stored;

    /**
     * @var bool
     */
    public $store_for_future_use;
}
