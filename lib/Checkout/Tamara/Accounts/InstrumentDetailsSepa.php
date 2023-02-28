<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\InstrumentDetails;

class InstrumentDetailsSepa implements InstrumentDetails
{
    /**
     * @var string
     */
    public $iban;

    /**
     * @var string
     */
    public $swift_bic;
}
