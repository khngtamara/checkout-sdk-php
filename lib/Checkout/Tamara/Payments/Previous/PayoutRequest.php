<?php

namespace Checkout\Tamara\Payments\Previous;

use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Payments\BillingDescriptor;
use Checkout\Tamara\Payments\PaymentRecipient;
use Checkout\Tamara\Payments\Previous\Destination\PaymentRequestDestination;
use Checkout\Tamara\Payments\RiskRequest;
use Checkout\Tamara\Payments\ShippingDetails;
use DateTime;

class PayoutRequest
{
    /**
     * @var \Checkout\Tamara\Payments\Previous\Destination\PaymentRequestDestination
     */
    public $destination;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string value of FundTransferType
     */
    public $fund_transfer_type;

    /**
     * @var string value of Currency
     */
    public $currency;

    /**
     * @var string value of PaymentType
     */
    public $payment_type;

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
     * @var \Checkout\Tamara\Common\CustomerRequest
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
     * @var PaymentRecipient
     */
    public $recipient;

    /**
     * @var array
     */
    public $metadata;

    /**
     * @var array
     */
    public $processing;
}
