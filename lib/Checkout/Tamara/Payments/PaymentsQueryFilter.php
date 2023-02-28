<?php

namespace Checkout\Tamara\Payments;

use Checkout\Tamara\Common\AbstractQueryFilter;

class PaymentsQueryFilter extends AbstractQueryFilter
{
    /**
     * @var int
     */
    public $limit;

    /**
     * @var int
     */
    public $skip;

    /**
     * @var string
     */
    public $reference;
}
