<?php

namespace Checkout\Tamara\Sources\Previous;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Sources\Previous\SourceData;
use Checkout\Tamara\Sources\Previous\SourceRequest;
use Checkout\Tamara\Sources\Previous\SourceType;

class SepaSourceRequest extends SourceRequest
{
    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $billing_address;

    /**
     * @var SourceData
     */
    public $source_data;

    public function __construct()
    {
        parent::__construct(SourceType::$sepa);
    }
}
