<?php

namespace Checkout\Tamara\Payments\Request\Source;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

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
