<?php

namespace Checkout\Tamara\Payments\Request\Source;

use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestBankAccountSource extends AbstractRequestSource
{

    public function __construct()
    {
        parent::__construct(PaymentSourceType::$bank_account);
    }

    /**
     * @var string
     */
    public $payment_method;

    /**
     * @var string
     */
    public $account_type;

    /**
     * @var string values of Country
     */
    public $country;

    /**
     * @var string
     */
    public $account_number;

    /**
     * @var string
     */
    public $bank_code;

    /**
     * @var \Checkout\Tamara\Common\AccountHolder
     */
    public $account_holder;
}
