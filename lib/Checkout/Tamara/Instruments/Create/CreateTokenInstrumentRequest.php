<?php

namespace Checkout\Tamara\Instruments\Create;

use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Common\InstrumentType;
use Checkout\Tamara\Instruments\Create\CreateCustomerInstrumentRequest;
use Checkout\Tamara\Instruments\Create\CreateInstrumentRequest;

class CreateTokenInstrumentRequest extends CreateInstrumentRequest
{

    public function __construct()
    {
        parent::__construct(InstrumentType::$token);
    }

    /**
     * @var string
     */
    public $token;

    /**
     * @var \Checkout\Tamara\Common\AccountHolder
     */
    public $account_holder;

    /**
     * @var CreateCustomerInstrumentRequest
     */
    public $customer;
}
