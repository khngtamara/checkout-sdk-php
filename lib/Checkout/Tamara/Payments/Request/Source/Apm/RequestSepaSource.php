<?php

namespace Checkout\Tamara\Payments\Request\Source\Apm;

use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Request\Source\AbstractRequestSource;

class RequestSepaSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$sepa);
    }

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
     * @var string value of Currency
     */
    public $currency;

    /**
     * @var string
     */
    public $mandate_id;

    /**
     * @var string
     */
    public $date_of_signature;

    /**
     * @var \Checkout\Tamara\Common\AccountHolder
     */
    public $account_holder;
}
