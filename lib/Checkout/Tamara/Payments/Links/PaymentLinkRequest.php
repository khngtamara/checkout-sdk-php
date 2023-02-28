<?php

namespace Checkout\Tamara\Payments\Links;

use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Common\MarketplaceData;
use Checkout\Tamara\Payments\BillingDescriptor;
use Checkout\Tamara\Payments\BillingInformation;
use Checkout\Tamara\Payments\PaymentRecipient;
use Checkout\Tamara\Payments\ProcessingSettings;
use Checkout\Tamara\Payments\RiskRequest;
use Checkout\Tamara\Payments\ShippingDetails;
use Checkout\Tamara\Payments\ThreeDsRequest;
use DateTime;

class PaymentLinkRequest
{
    /**
     * @var int
     */
    public $amount;

    /**
     * @var string value of Currency
     */
    public $currency;

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
    public $expires_in;

    /**
     * @var CustomerRequest
     */
    public $customer;

    /**
     * @var ShippingDetails
     */
    public $shipping;

    /**
     * @var \Checkout\Tamara\Payments\BillingInformation
     */
    public $billing;

    /**
     * @var PaymentRecipient
     */
    public $recipient;

    /**
     * @var \Checkout\Tamara\Payments\ProcessingSettings
     */
    public $processing;

    /**
     * @var array of Product
     */
    public $products;

    /**
     * @var RiskRequest
     */
    public $risk;

    /**
     * @var string
     */
    public $return_url;

    /**
     * @var array
     */
    public $metadata;

    /**
     * @var string
     */
    public $locale;

    /**
     * @var \Checkout\Tamara\Payments\ThreeDsRequest
     */
    public $three_ds;

    /**
     * @var bool
     */
    public $capture;

    /**
     * @var DateTime
     */
    public $capture_on;

    /**
     * @var string value of PaymentType
     */
    public $payment_type;

    /**
     * @var string
     */
    public $payment_ip;

    /**
     * @var BillingDescriptor
     */
    public $billing_descriptor;

    /**
     * @var array of PaymentSourceType
     */
    public $allow_payment_methods;

    //Not available on previous

    /**
     * @var string
     */
    public $processing_channel_id;

    /**
     * @deprecated This property will be removed in the future, and should be used {@link amount_allocations} instead
     * @var MarketplaceData
     */
    public $marketplace;

    /**
     * @var array values of AmountAllocations
     */
    public $amount_allocations;
}
