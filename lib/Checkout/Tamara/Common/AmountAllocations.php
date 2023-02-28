<?php

namespace Checkout\Tamara\Common;

use Checkout\Tamara\Common\Commission;

class AmountAllocations
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
     * @var Commission
     */
    public $commission;
}
