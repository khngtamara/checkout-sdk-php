<?php

namespace Checkout\Tamara;

use Checkout\Tamara\AbstractStaticKeysSdkCredentials;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\SdkAuthorization;

class StaticKeysSdkCredentials extends AbstractStaticKeysSdkCredentials
{

    /**
     * @param string|null $secretKey
     * @param string|null $publicKey
     */
    public function __construct($secretKey, $publicKey)
    {
        parent::__construct($secretKey, $publicKey);
    }

    /**
     * @throws CheckoutAuthorizationException
     */
    public function getAuthorization($authorizationType)
    {
        switch ($authorizationType) {
            case AuthorizationType::$publicKey:
            case AuthorizationType::$publicKeyOrOAuth:
                if (empty($this->publicKey)) {
                    throw CheckoutAuthorizationException::invalidPublicKey();
                }
                return new SdkAuthorization(PlatformType::$default, $this->publicKey);
            case AuthorizationType::$secretKey:
            case AuthorizationType::$secretKeyOrOAuth:
                if (empty($this->secretKey)) {
                    throw CheckoutAuthorizationException::invalidSecretKey();
                }
                return new SdkAuthorization(PlatformType::$default, $this->secretKey);
            default:
                throw CheckoutAuthorizationException::invalidAuthorization($authorizationType);
        }
    }
}
