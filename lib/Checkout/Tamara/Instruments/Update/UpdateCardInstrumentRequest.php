<?php

namespace Checkout\Tamara\Instruments\Update;

use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Common\InstrumentType;
use Checkout\Tamara\Instruments\Update\UpdateCustomerRequest;
use Checkout\Tamara\Instruments\Update\UpdateInstrumentRequest;

class UpdateCardInstrumentRequest extends UpdateInstrumentRequest
{
    public function __construct()
    {
        parent::__construct(InstrumentType::$card);
    }

    /**
     * @var int
     */
    public $expiry_month;

    /**
     * @var int
     */
    public $expiry_year;

    /**
     * @var string
     */
    public $name;

    /**
     * @var UpdateCustomerRequest
     */
    public $customer;

    /**
     * @var AccountHolder
     */
    public $account_holder;
}
