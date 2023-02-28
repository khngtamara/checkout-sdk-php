<?php

namespace Checkout\Tamara\Risk\Source;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Common\Phone;
use Checkout\Tamara\Risk\Source\RiskPaymentRequestSource;

class RiskRequestTokenSource extends RiskPaymentRequestSource
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
     * @var Address
     */
    public $billing_address;

    /**
     * @var Phone
     */
    public $phone;
}
