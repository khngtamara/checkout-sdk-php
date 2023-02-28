<?php

namespace Checkout\Tamara\Instruments\Create;

use Checkout\Tamara\Common\Phone;

class CreateCustomerInstrumentRequest
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $name;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $phone;

    /**
     * @var bool
     */
    public $default;
}
