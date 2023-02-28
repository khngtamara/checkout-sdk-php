<?php

namespace Checkout\Tamara\Payments\Request\Source;

use Checkout\Tamara\Payments\Request\Source\PayoutRequestSource;
use Checkout\Tamara\Payments\Request\Source\PayoutSourceType;

class PayoutRequestEntitySource extends PayoutRequestSource
{
    public function __construct()
    {
        parent::__construct(PayoutSourceType::$entity);
    }

    /**
     * @var string
     */
    public $id;
}
