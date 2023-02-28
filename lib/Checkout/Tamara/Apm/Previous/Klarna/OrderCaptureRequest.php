<?php

namespace Checkout\Tamara\Apm\Previous\Klarna;

use Checkout\Tamara\Common\ShippingInfo;
use Checkout\Tamara\Apm\Previous\Klarna\Klarna;
use Checkout\Tamara\Common\PaymentSourceType;

class OrderCaptureRequest
{
    public function __construct()
    {
        $this->type = PaymentSourceType::$klarna;
    }

    /**
     * @var string value of PaymentSourceType
     */
    public $type;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var int
     */
    public $reference;

    /**
     * @var array
     */
    public $metadata;

    /**
     * @var Klarna
     */
    public $klarna;

    /**
     * @var \Checkout\Tamara\Common\ShippingInfo
     */
    public $shipping_info;

    /**
     * @var int
     */
    public $shipping_delay;
}
