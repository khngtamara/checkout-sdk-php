<?php

namespace Checkout\Tamara\Sessions\Source;

use Checkout\Tamara\Common\Phone;

abstract class SessionSource
{
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @var string value of SessionSourceType
     */
    public $type;

    /**
     * @var string value of SessionScheme
     */
    public $scheme;

    /**
     * @var string value of SessionAddress
     */
    public $billing_address;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $home_phone;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $mobile_phone;

    /**
     * @var \Checkout\Tamara\Common\Phone
     */
    public $work_phone;

    /**
     * @var string
     */
    public $email;
}
