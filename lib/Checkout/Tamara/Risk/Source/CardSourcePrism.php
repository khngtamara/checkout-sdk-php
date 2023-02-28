<?php

namespace Checkout\Tamara\Risk\Source;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Common\Phone;
use Checkout\Tamara\Risk\Source\RiskPaymentRequestSource;

class CardSourcePrism extends RiskPaymentRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$card);
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
     * @var \Checkout\Tamara\Common\Address
     */
    public $billing_address;

    /**
     * @var Phone
     */
    public $phone;
}
