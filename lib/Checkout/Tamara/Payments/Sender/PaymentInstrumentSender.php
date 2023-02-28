<?php

namespace Checkout\Tamara\Payments\Sender;

use Checkout\Tamara\Payments\Sender\PaymentSender;
use Checkout\Tamara\Payments\Sender\PaymentSenderType;

class PaymentInstrumentSender extends PaymentSender
{
    public function __construct()
    {
        parent::__construct(PaymentSenderType::$instrument);
    }

}
