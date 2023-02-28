<?php

namespace Checkout\Tamara\Payments\Previous\Source;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;

class RequestCustomerSource extends AbstractRequestSource
{

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$customer);
    }

    /**
     * @var string
     */
    public $id;
}
