<?php

namespace Checkout\Tamara\Payments;

use Checkout\Tamara\Payments\PassengerName;

class Passenger
{
    /**
     * @var PassengerName
     */
    public $name;

    /**
     * @var string
     */
    public $date_of_birth;

    /**
     * @var string values of Country
     */
    public $country_code;
}
