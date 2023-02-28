<?php

namespace Checkout\Tamara\Payments\Previous\Destination;

use Checkout\Tamara\Payments\PaymentDestinationType;
use Checkout\Tamara\Payments\Previous\Destination\PaymentRequestDestination;

class PaymentRequestIdDestination extends PaymentRequestDestination
{
    public function __construct()
    {
        parent::__construct(PaymentDestinationType::$id);
    }

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;
}
