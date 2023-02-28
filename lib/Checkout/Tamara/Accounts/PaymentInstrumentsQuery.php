<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Common\AbstractQueryFilter;

class PaymentInstrumentsQuery extends AbstractQueryFilter
{
    /**
     * @var string
     */
    public $status;
}
