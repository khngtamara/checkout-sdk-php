<?php

namespace Checkout\Tamara\Financial;

use Checkout\Tamara\Common\AbstractQueryFilter;

class FinancialActionsQuery extends AbstractQueryFilter
{
    /**
     * @var string
     */
    public $payment_id;

    /**
     * @var string
     */
    public $action_id;

    /**
     * @var int
     */
    public $limit;

    /**
     * @var string
     */
    public $pagination_token;
}
