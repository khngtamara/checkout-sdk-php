<?php

namespace Checkout\Tamara\Tokens;

use Checkout\Tamara\Tokens\ApplePayTokenData;
use Checkout\Tamara\Tokens\TokenType;
use Checkout\Tamara\Tokens\WalletTokenRequest;

class ApplePayTokenRequest extends WalletTokenRequest
{
    public function __construct()
    {
        parent::__construct(TokenType::$applepay);
    }

    /**
     * @var ApplePayTokenData
     */
    public $token_data;
}
