<?php

namespace Checkout\Tamara\Payments\Sender;

use Checkout\Tamara\Common\AccountHolderIdentification;
use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Payments\Sender\PaymentSender;
use Checkout\Tamara\Payments\Sender\PaymentSenderType;

class PaymentIndividualSender extends PaymentSender
{
    public function __construct()
    {
        parent::__construct(PaymentSenderType::$individual);
    }

    /**
     * @var string
     */
    public $fist_name;

    /**
     * @var string
     */
    public $middle_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $dob;

    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $address;

    /**
     * @var AccountHolderIdentification
     */
    public $identification;

    /**
     * @var string
     */
    public $reference_type;

    /**
     * @var string
     */
    public $source_of_funds;

    /**
     * @var string
     */
    public $date_of_birth;

    /**
     * @var string values of Country
     */
    public $country_of_birth;

    /**
     * @var string values of Country
     */
    public $nationality;

}
