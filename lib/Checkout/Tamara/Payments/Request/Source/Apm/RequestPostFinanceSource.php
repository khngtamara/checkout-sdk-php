<?php

namespace Checkout\Tamara\Payments\Request\Source\Apm;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;

class RequestPostFinanceSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$postfinance);
    }

    /**
     * @var string values of Country
     */
    public $payment_country;

    /**
     * @var string
     */
    public $account_holder_name;

    /**
     * @var string
     */
    public $billing_descriptor;
}
