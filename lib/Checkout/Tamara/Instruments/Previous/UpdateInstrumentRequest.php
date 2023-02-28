<?php

namespace Checkout\Tamara\Instruments\Previous;

use Checkout\Tamara\Instruments\Previous\InstrumentAccountHolder;
use Checkout\Tamara\Instruments\Previous\UpdateInstrumentCustomerRequest;

class UpdateInstrumentRequest
{
    /**
     * @var int
     */
    public $expiry_month;

    /**
     * @var int
     */
    public $expiry_year;

    /**
     * @var string
     */
    public $name;

    /**
     * @var InstrumentAccountHolder
     */
    public $account_holder;

    /**
     * @var UpdateInstrumentCustomerRequest
     */
    public $customer;
}
