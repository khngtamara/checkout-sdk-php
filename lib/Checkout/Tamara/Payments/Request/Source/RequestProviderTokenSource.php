<?php

namespace Checkout\Tamara\Payments\Request\Source;

use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestProviderTokenSource extends AbstractRequestSource
{

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$provider_token);
    }

    /**
     * @var string
     */
    public $payment_method;

    /**
     * @var string
     */
    public $token;

    /**
     * @var \Checkout\Tamara\Common\AccountHolder
     */
    public $account_holder;
}
