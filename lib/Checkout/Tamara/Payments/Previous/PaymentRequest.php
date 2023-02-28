<?php

namespace Checkout\Tamara\Payments\Previous;

use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Payments\BillingDescriptor;
use Checkout\Tamara\Payments\PaymentRecipient;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;
use Checkout\Tamara\Payments\ProcessingSettings;
use Checkout\Tamara\Payments\RiskRequest;
use Checkout\Tamara\Payments\ShippingDetails;
use Checkout\Tamara\Payments\ThreeDsRequest;
use DateTime;

class PaymentRequest
{
    /**
     * @var AbstractRequestSource
     */
    public $source;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string value of Currency
     */
    public $currency;

    /**
     * @var string value of PaymentType
     */
    public $payment_type;

    /**
     * @var bool
     */
    public $merchant_initiated;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var string
     */
    public $description;

    /**
     * @var bool
     */
    public $capture;

    /**
     * @var DateTime
     */
    public $capture_on;

    /**
     * @var CustomerRequest
     */
    public $customer;

    /**
     * @var \Checkout\Tamara\Payments\BillingDescriptor
     */
    public $billing_descriptor;

    /**
     * @var ShippingDetails
     */
    public $shipping;

    /**
     * @var string
     */
    public $previous_payment_id;

    /**
     * @var \Checkout\Tamara\Payments\RiskRequest
     */
    public $risk;

    /**
     * @var string
     */
    public $success_url;

    /**
     * @var string
     */
    public $failure_url;

    /**
     * @var string
     */
    public $payment_ip;

    /**
     * @var \Checkout\Tamara\Payments\ThreeDsRequest
     */
    public $three_ds;

    /**
     * @var PaymentRecipient
     */
    public $recipient;

    /**
     * @var array
     */
    public $metadata;

    /**
     * @var \Checkout\Tamara\Payments\ProcessingSettings
     */
    public $processing;
}
