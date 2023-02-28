<?php

namespace Checkout\Tamara\Instruments\Create;

use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Common\BankDetails;
use Checkout\Tamara\Common\InstrumentType;
use Checkout\Tamara\Instruments\Create\CreateCustomerInstrumentRequest;
use Checkout\Tamara\Instruments\Create\CreateInstrumentRequest;

class CreateBankAccountInstrumentRequest extends CreateInstrumentRequest
{
    public function __construct()
    {
        parent::__construct(InstrumentType::$bank_account);
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
    public $bban;

    /**
     * @var string
     */
    public $swift_bic;

    /**
     * @var string value of Currency
     */
    public $currency;

    /**
     * @var string values of Country
     */
    public $country;

    /**
     * @var string
     */
    public $processing_channel_id;

    /**
     * @var \Checkout\Tamara\Common\AccountHolder
     */
    public $account_holder;

    /**
     * @var \Checkout\Tamara\Common\BankDetails
     */
    public $bank_details;

    /**
     * @var CreateCustomerInstrumentRequest
     */
    public $customer;
}
