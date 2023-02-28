<?php

namespace Checkout\Tamara\Common;

use Checkout\Tamara\Common\Phone;

class CustomerRequest
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
     * @var Phone
     */
    public $phone;
}
