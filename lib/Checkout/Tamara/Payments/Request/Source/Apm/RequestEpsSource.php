<?php

namespace Checkout\Tamara\Payments\Request\Source\Apm;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestEpsSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$eps);
    }

    /**
     * @var string
     */
    public $purpose;
}
