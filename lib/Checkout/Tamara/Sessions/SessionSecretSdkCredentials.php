<?php

namespace Checkout\Tamara\Sessions;

use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\SdkAuthorization;
use Checkout\Tamara\SdkCredentialsInterface;

final class SessionSecretSdkCredentials implements SdkCredentialsInterface
{
    public $secret;

    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @param $authorizationType
     * @return SdkAuthorization
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    public function getAuthorization($authorizationType)
    {
        if ($authorizationType == AuthorizationType::$custom) {
            return new SdkAuthorization(AuthorizationType::$custom, $this->secret);
        }
        throw CheckoutAuthorizationException::invalidAuthorization($authorizationType);
    }
}
