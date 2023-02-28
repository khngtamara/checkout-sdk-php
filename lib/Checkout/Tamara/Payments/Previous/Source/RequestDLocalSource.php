<?php

namespace Checkout\Tamara\Payments\Previous\Source;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Common\Phone;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;

class RequestDLocalSource extends AbstractRequestSource
{

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$dlocal);
    }

    /**
     * @var string
     */
    public $number;

    /**
     * @var int
     */
    public $expiry_month;

    /**
     * @var int
     */
    public $expiry_year;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $cvv;

    /**
     * @var bool
     */
    public $stored;

    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $billing_address;

    /**
     * @var Phone
     */
    public $phone;
}
