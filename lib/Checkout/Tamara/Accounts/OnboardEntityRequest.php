<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\Company;
use Checkout\Tamara\Accounts\ContactDetails;
use Checkout\Tamara\Accounts\Individual;
use Checkout\Tamara\Accounts\Profile;

class OnboardEntityRequest
{
    /**
     * @var string
     */
    public $reference;

    /**
     * @var ContactDetails
     */
    public $contact_details;

    /**
     * @var Profile
     */
    public $profile;

    /**
     * @var Company
     */
    public $company;

    /**
     * @var Individual
     */
    public $individual;
}
