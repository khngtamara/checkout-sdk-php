<?php

namespace Checkout\Tamara\Payments\Request\Source\Apm;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestIdealSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$ideal);
    }

    /**
     * @var string
     */
    public $bic;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $language;
}
