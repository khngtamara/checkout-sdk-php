<?php

namespace Checkout\Tamara\Payments;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\Phone;

class ShippingDetails
{
    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $address;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $phone;

    /**
     * @var string
     */
    public $from_address_zip;
}
