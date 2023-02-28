<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\InstrumentDetails;
use Checkout\Tamara\Accounts\InstrumentDocument;

class PaymentInstrumentRequest
{
    /**
     * @var string
     */
    public $label;

    /**
     * @var string value of InstrumentType
     */
    public $type;

    /**
     * @var string value of Currency
     */
    public $currency;

    /**
     * @var string values of Country
     */
    public $country;

    /**
     * @var bool
     */
    public $default;

    /**
     * @var InstrumentDocument
     */
    public $document;

    /**
     * @var InstrumentDetails
     */
    public $instrument_details;
}
