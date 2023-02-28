<?php

namespace Checkout\Tamara\Reconciliation\Previous;

use Checkout\Tamara\Common\QueryFilterDateRange;

class ReconciliationQueryPaymentsFilter extends QueryFilterDateRange
{
    /**
     * @var int
     */
    public $limit;

    /**
     * @var string
     */
    public $reference;
}
