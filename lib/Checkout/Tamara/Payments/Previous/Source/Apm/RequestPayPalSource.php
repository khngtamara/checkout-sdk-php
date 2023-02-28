<?php

namespace Checkout\Tamara\Payments\Previous\Source\Apm;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;

class RequestPayPalSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$paypal);
    }

    /**
     * @var string
     */
    public $invoice_number;

    /**
     * @var string
     */
    public $recipient_name;

    /**
     * @var string
     */
    public $logo_url;

    /**
     * @var array
     */
    public $stc;
}
