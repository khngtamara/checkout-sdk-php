<?php

namespace Checkout\Tamara\Risk\PreAuthentication;

use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Risk\Device;
use Checkout\Tamara\Risk\RiskPayment;
use Checkout\Tamara\Risk\RiskShippingDetails;
use Checkout\Tamara\Risk\Source\RiskPaymentRequestSource;
use DateTime;

class PreAuthenticationAssessmentRequest
{
    /**
     * @var DateTime
     */
    public $date;

    /**
     * @var RiskPaymentRequestSource
     */
    public $source;

    /**
     * @var CustomerRequest
     */
    public $customer;

    /**
     * @var RiskPayment
     */
    public $payment;

    /**
     * @var RiskShippingDetails
     */
    public $shipping;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string value of Currency
     */
    public $currency;

    /**
     * @var \Checkout\Tamara\Risk\Device
     */
    public $device;

    /**
     * @var array
     */
    public $metadata;
}
