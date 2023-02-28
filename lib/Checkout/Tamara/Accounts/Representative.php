<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\Identification;
use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Accounts\DateOfBirth;
use Checkout\Tamara\Accounts\PlaceOfBirth;
use Checkout\Tamara\Common\Phone;

class Representative
{
    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var \Checkout\Tamara\Common\Address
     */
    public $address;

    /**
     * @var Identification
     */
    public $identification;

    /**
     * @var Phone
     */
    public $phone;

    /**
     * @var DateOfBirth
     */
    public $date_of_birth;

    /**
     * @var PlaceOfBirth
     */
    public $place_of_birth;

    /**
     * @var array values of EntityRoles
     */
    public $roles;
}
