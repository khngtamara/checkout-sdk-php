<?php

namespace Checkout\Tamara\Payments\Previous\Source;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;

class RequestIdSource extends AbstractRequestSource
{

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$id);
    }

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $cvv;

    /**
     * @var bool
     */
    public $stored;

    /**
     * @var bool
     */
    public $store_for_future_use;
}
