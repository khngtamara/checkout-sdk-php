<?php

namespace Checkout\Tamara\Payments\Request\Source\Apm;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestIllicadoSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$illicado);
    }

    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $billing_address;
}
