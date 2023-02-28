<?php

namespace Checkout\Tamara\Sessions\Channel;

class SdkEphemeralPublicKey
{
    /**
     * @var string
     */
    public $kty;

    /**
     * @var string
     */
    public $crv;

    /**
     * @var string
     */
    public $x;

    /**
     * @var string
     */
    public $y;
}
