<?php

namespace Checkout\Tamara\Payments\Request\Source\Apm;

use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestAfterPaySource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$afterpay);
    }

    /**
     * @var \Checkout\Tamara\Common\AccountHolder
     */
    public $account_holder;
}
