<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\AccountPhone;
use Checkout\Tamara\Accounts\DateOfBirth;
use Checkout\Tamara\Common\AccountHolderIdentification;
use Checkout\Tamara\Common\Address;

abstract class AccountsAccountHolder
{
    /**
     * @var string value of AccountHolderType
     */
    public $type;

    /**
     * @var string
     */
    public $tax_id;

    /**
     * @var DateOfBirth
     */
    public $date_of_birth;

    /**
     * @var string values of Country
     */
    public $country_of_birth;

    /**
     * @var string
     */
    public $residential_status;

    /**
     * @var Address
     */
    public $billing_address;

    /**
     * @var AccountPhone
     */
    public $phone;

    /**
     * @var AccountHolderIdentification
     */
    public $identification;

    /**
     * @var string
     */
    public $email;
}
