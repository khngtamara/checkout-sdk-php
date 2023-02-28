<?php

namespace Checkout\Tamara\Payments\Request\Source;

use Checkout\Tamara\Payments\Request\Source\PayoutRequestSource;
use Checkout\Tamara\Payments\Request\Source\PayoutSourceType;

class PayoutRequestCurrencyAccountSource extends PayoutRequestSource
{
    public function __construct()
    {
        parent::__construct(PayoutSourceType::$currencyAccount);
    }

    /**
     * @var string
     */
    public $id;
}
