<?php

namespace Checkout\Tamara\Payments\Request;

use Checkout\Tamara\Payments\Destination\PaymentRequestDestination;
use Checkout\Tamara\Payments\Request\PaymentInstruction;
use Checkout\Tamara\Payments\Request\Source\PayoutRequestSource;
use Checkout\Tamara\Payments\Sender\PaymentSender;
use Checkout\Tamara\Payments\Request\PayoutBillingDescriptor;

class PayoutRequest
{

    /**
     * @var PayoutRequestSource
     */
    public $source;

    /**
     * @var \Checkout\Tamara\Payments\Destination\PaymentRequestDestination
     */
    public $destination;

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
     * @var PayoutBillingDescriptor
     */
    public $billing_descriptor;

    /**
     * @var \Checkout\Tamara\Payments\Sender\PaymentSender
     */
    public $sender;

    /**
     * @var PaymentInstruction
     */
    public $instruction;

    /**
     * @var string
     */
    public $processing_channel_id;
}
