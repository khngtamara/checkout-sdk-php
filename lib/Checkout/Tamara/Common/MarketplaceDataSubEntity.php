<?php

namespace Checkout\Tamara\Common;

use Checkout\Tamara\Common\MarketplaceCommission;

class MarketplaceDataSubEntity
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var MarketplaceCommission
     */
    public $commission;
}
