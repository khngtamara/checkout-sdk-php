<?php

namespace Checkout\Tamara\Risk\PreCapture;

class AuthorizationResult
{
    /**
     * @var string
     */
    public $avs_code;

    /**
     * @var string
     */
    public $cvv_result;
}
