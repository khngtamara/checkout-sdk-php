<?php

namespace Checkout\Tamara\Payments;

use Checkout\Tamara\Common\MarketplaceData;
use Checkout\Tamara\Payments\BillingDescriptor;
use Checkout\Tamara\Payments\PaymentCustomerRequest;
use Checkout\Tamara\Payments\ProcessingSettings;
use Checkout\Tamara\Payments\ShippingDetails;

class CaptureRequest
{
    /**
     * @var int
     */
    public $amount;

    /**
     * @var string value of CaptureType
     */
    public $capture_type;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var PaymentCustomerRequest
     */
    public $customer;

    /**
     * @var string
     */
    public $description;

    /**
     * @var BillingDescriptor
     */
    public $billing_descriptor;

    /**
     * @var ShippingDetails
     */
    public $shipping;

    /**
     * @var array of Checkout\Tamara\Payments\Product
     */
    public $items;

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
     * @var ProcessingSettings
     */
    public $processing;

    /**
     * @var array
     */
    public $metadata;
}
