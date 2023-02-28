<?php

namespace Checkout\Tamara\Common;

use Checkout\Tamara\Common\AbstractQueryFilter;
use DateTime;

class QueryFilterDateRange extends AbstractQueryFilter
{
    /**
     * @var DateTime
     */
    public $from;

    /**
     * @var DateTime
     */
    public $to;
}
