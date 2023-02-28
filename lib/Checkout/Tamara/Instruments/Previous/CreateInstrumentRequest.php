<?php

namespace Checkout\Tamara\Instruments\Previous;

use Checkout\Tamara\Instruments\Previous\InstrumentAccountHolder;
use Checkout\Tamara\Instruments\Previous\InstrumentCustomerRequest;

class CreateInstrumentRequest
{

    /**
     * @var string value of InstrumentType
     */
    public $type;

    /**
     * @var string
     */
    public $token;

    /**
     * @var InstrumentAccountHolder
     */
    public $account_holder;

    /**
     * @var InstrumentCustomerRequest
     */
    public $customer;
}
