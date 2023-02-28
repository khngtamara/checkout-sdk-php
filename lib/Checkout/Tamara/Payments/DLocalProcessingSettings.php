<?php

namespace Checkout\Tamara\Payments;

use Checkout\Tamara\Payments\Installments;
use Checkout\Tamara\Payments\Payer;

class DLocalProcessingSettings
{
    /**
     * @var string values of Country
     */
    public $country;

    /**
     * @var Payer
     */
    public $payer;

    /**
     * @var Installments
     */
    public $installments;

}
