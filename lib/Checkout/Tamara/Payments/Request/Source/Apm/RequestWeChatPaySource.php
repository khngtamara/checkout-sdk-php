<?php

namespace Checkout\Tamara\Payments\Request\Source\Apm;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestWeChatPaySource extends AbstractRequestSource
{
    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $billing_address;

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$wechatpay);
    }
}
