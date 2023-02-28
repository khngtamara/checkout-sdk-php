<?php

namespace Checkout\Tamara\Payments\Destination;

use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Common\BankDetails;
use Checkout\Tamara\Payments\PaymentDestinationType;
use Checkout\Tamara\Payments\Destination\PaymentRequestDestination;

class PaymentBankAccountDestination extends PaymentRequestDestination
{

    public function __construct()
    {
        parent::__construct(PaymentDestinationType::$bank_account);
    }

    /**
     * @var string value of AccountType
     */
    public $account_type;

    /**
     * @var string
     */
    public $account_number;

    /**
     * @var string
     */
    public $bank_code;

    /**
     * @var string
     */
    public $branch_code;

    /**
     * @var string
     */
    public $iban;

    /**
     * @var string
     */
    public $swift_bic;

    /**
     * @var string values of Country
     */
    public $country;

    /**
     * @var AccountHolder
     */
    public $account_holder;

    /**
     * @var BankDetails
     */
    public $bank;
}
