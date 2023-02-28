<?php

namespace Checkout\Tamara\Payments\Previous\Source\Apm;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;

class RequestSepaSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$id);
    }

    /**
     * @var string
     */
    public $id;
}
