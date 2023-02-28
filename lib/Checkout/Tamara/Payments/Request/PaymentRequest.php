<?php

namespace Checkout\Tamara\Payments\Request;

use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Common\MarketplaceData;
use Checkout\Tamara\Payments\BillingDescriptor;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;
use Checkout\Tamara\Payments\Sender\PaymentSender;
use Checkout\Tamara\Payments\PaymentRecipient;
use Checkout\Tamara\Payments\ProcessingSettings;
use Checkout\Tamara\Payments\RiskRequest;
use Checkout\Tamara\Payments\ShippingDetails;
use Checkout\Tamara\Payments\ThreeDsRequest;
use DateTime;

class PaymentRequest
{
    /**
     * @var \Checkout\Tamara\Payments\Request\Source\AbstractRequestSource
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
     * @var string value of AuthorizationType
     */
    public $authorization_type;

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
     * @var BillingDescriptor
     */
    public $billing_descriptor;

    /**
     * @var ShippingDetails
     */
    public $shipping;

    /**
     * @var ThreeDsRequest
     */
    public $three_ds;

    /**
     * @var string
     */
    public $processing_channel_id;

    /**
     * @var string
     */
    public $previous_payment_id;

    /**
     * @var RiskRequest
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
     * @var \Checkout\Tamara\Payments\Sender\PaymentSender
     */
    public $sender;

    /**
     * @var \Checkout\Tamara\Payments\PaymentRecipient
     */
    public $recipient;

    /**
     * @deprecated This property will be removed in the future, and should be used {@link amount_allocations} instead
     * @var MarketplaceData
     */
    public $marketplace;

    /**
     * @var array values of AmountAllocations
     */
    public $amount_allocations;

    /**
     * @var \Checkout\Tamara\Payments\ProcessingSettings
     */
    public $processing;

    /**
     * @var array
     */
    public $metadata;

    /**
     * @var array of Checkout\Tamara\Payments\Product
     */
    public $items;
}
