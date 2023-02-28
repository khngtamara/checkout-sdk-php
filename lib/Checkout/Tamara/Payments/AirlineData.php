<?php

namespace Checkout\Tamara\Payments;

use Checkout\Tamara\Payments\Passenger;
use Checkout\Tamara\Payments\Ticket;

class AirlineData
{
    /**
     * @var Ticket
     */
    public $ticket;

    /**
     * @var Passenger
     */
    public $passenger;

    /**
     * @var array of FlightLegDetails
     */
    public $flight_leg_details;
}
