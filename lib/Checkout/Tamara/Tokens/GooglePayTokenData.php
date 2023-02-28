<?php

namespace Checkout\Tamara\Tokens;

class GooglePayTokenData
{
    /**
     * @var string
     */
    public $signature;

    /**
     * @var string
     */
    public $protocolVersion;

    /**
     * @var string
     */
    public $signedMessage;
}
