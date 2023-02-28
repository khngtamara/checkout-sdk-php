<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\InstrumentDetails;

class InstrumentDetailsFasterPayments implements InstrumentDetails
{
    /**
     * @var string
     */
    public $account_number;

    /**
     * @var string
     */
    public $bank_code;
}
