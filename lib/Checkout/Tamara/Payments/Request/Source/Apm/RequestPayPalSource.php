<?php

namespace Checkout\Tamara\Payments\Request\Source\Apm;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\BillingPlan;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestPayPalSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$paypal);
    }

    /**
     * @var \Checkout\Tamara\Payments\BillingPlan
     */
    public $plan;
}
