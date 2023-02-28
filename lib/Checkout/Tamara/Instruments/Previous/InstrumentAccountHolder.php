<?php

namespace Checkout\Tamara\Instruments\Previous;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\Phone;

class InstrumentAccountHolder
{
    /**
     * @var Address
     */
    public $billing_address;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $phone;
}
