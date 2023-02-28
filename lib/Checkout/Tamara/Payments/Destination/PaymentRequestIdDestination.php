<?php

namespace Checkout\Tamara\Payments\Destination;

use Checkout\Tamara\Payments\Destination\PaymentRequestDestination;
use Checkout\Tamara\Payments\PaymentDestinationType;

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
}
