<?php

namespace Checkout\Tamara\Risk\Source;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Risk\Source\RiskPaymentRequestSource;

class IdSourcePrism extends RiskPaymentRequestSource
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $cvv;

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$id);
    }
}
