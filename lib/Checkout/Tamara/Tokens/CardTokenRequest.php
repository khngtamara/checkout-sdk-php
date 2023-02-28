<?php

namespace Checkout\Tamara\Tokens;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\Phone;

class CardTokenRequest
{
    /**
     * @var string
     */
    public $type = "card";

    /**
     * @var string
     */
    public $number;

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
     * @var string
     */
    public $cvv;

    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $billing_address;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $phone;
}
