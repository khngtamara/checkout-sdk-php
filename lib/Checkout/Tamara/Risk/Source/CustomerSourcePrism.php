<?php

namespace Checkout\Tamara\Risk\Source;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Risk\Source\RiskPaymentRequestSource;

class CustomerSourcePrism extends RiskPaymentRequestSource
{
    /**
     * @var string
     */
    public $id;

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$customer);
    }
}
