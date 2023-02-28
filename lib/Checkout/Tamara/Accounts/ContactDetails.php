<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\EntityEmailAddresses;
use Checkout\Tamara\Common\Phone;

class ContactDetails
{
    /**
     * @var Phone
     */
    public $phone;

    /**
     * @var EntityEmailAddresses
     */
    public $email_addresses;
}
