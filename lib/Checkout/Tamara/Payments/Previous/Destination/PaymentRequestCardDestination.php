<?php

namespace Checkout\Tamara\Payments\Previous\Destination;

use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\Phone;
use Checkout\Tamara\Payments\PaymentDestinationType;
use Checkout\Tamara\Payments\Previous\Destination\PaymentRequestDestination;

class PaymentRequestCardDestination extends PaymentRequestDestination
{

    public function __construct()
    {
        parent::__construct(PaymentDestinationType::$card);
    }

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
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $name;

    /**
     * @var Address
     */
    public $billing_address;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $phone;
}
