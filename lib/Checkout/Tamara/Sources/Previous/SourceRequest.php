<?php

namespace Checkout\Tamara\Sources\Previous;

use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Common\Phone;

abstract class SourceRequest
{
    /**
     * @var string value of SourceType
     */
    public $type;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $phone;

    /**
     * @var CustomerRequest
     */
    public $customer;

    public function __construct($type)
    {
        $this->type = $type;
    }
}
