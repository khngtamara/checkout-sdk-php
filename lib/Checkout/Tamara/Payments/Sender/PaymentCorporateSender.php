<?php

namespace Checkout\Tamara\Payments\Sender;

use Checkout\Tamara\Common\AccountHolderIdentification;
use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Payments\Sender\PaymentSender;
use Checkout\Tamara\Payments\Sender\PaymentSenderType;

class PaymentCorporateSender extends PaymentSender
{
    public function __construct()
    {
        parent::__construct(PaymentSenderType::$corporate);
    }

    /**
     * @var string
     */
    public $company_name;

    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $address;

    /**
     * @var string
     */
    public $reference_type;

    /**
     * @var string
     */
    public $source_of_funds;

    /**
     * @var AccountHolderIdentification
     */
    public $identification;
}
