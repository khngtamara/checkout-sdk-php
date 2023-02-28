<?php

namespace Checkout\Tamara\Tokens;

use Checkout\Tamara\Tokens\GooglePayTokenData;
use Checkout\Tamara\Tokens\TokenType;
use Checkout\Tamara\Tokens\WalletTokenRequest;

class GooglePayTokenRequest extends WalletTokenRequest
{
    public function __construct()
    {
        parent::__construct(TokenType::$googlepay);
    }

    /**
     * @var GooglePayTokenData
     */
    public $token_data;
}
