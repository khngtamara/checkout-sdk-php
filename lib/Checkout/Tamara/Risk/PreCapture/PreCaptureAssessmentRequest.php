<?php

namespace Checkout\Tamara\Risk\PreCapture;

use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Risk\Device;
use Checkout\Tamara\Risk\PreCapture\AuthenticationResult;
use Checkout\Tamara\Risk\PreCapture\AuthorizationResult;
use Checkout\Tamara\Risk\RiskPayment;
use Checkout\Tamara\Risk\RiskShippingDetails;
use Checkout\Tamara\Risk\Source\RiskPaymentRequestSource;
use DateTime;

class PreCaptureAssessmentRequest
{
    /**
     * @var string
     */
    public $assessment_id;

    /**
     * @var DateTime
     */
    public $date;

    /**
     * @var \Checkout\Tamara\Risk\Source\RiskPaymentRequestSource
     */
    public $source;

    /**
     * @var \Checkout\Tamara\Common\CustomerRequest
     */
    public $customer;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string value of Currency
     */
    public $currency;

    /**
     * @var RiskPayment
     */
    public $payment;

    /**
     * @var \Checkout\Tamara\Risk\RiskShippingDetails
     */
    public $shipping;

    /**
     * @var \Checkout\Tamara\Risk\Device
     */
    public $device;

    /**
     * @var array
     */
    public $metadata;

    /**
     * @var AuthenticationResult
     */
    public $authentication_result;

    /**
     * @var AuthorizationResult
     */
    public $authorization_result;
}
