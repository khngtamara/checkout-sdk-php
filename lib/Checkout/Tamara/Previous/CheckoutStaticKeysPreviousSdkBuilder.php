<?php

namespace Checkout\Tamara\Previous;

use Checkout\Tamara\AbstractStaticKeysCheckoutSdkBuilder;
use Checkout\Tamara\ApiClient;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Previous\CheckoutApi;
use Checkout\Tamara\Previous\PreviousStaticKeysSdkCredentials;
use Checkout\Tamara\SdkCredentialsInterface;

class CheckoutStaticKeysPreviousSdkBuilder extends AbstractStaticKeysCheckoutSdkBuilder
{

    const PUBLIC_KEY_PATTERN = "/^pk_(test_)?(\\w{8})-(\\w{4})-(\\w{4})-(\\w{4})-(\\w{12})$/";
    const SECRET_KEY_PATTERN = "/^sk_(test_)?(\\w{8})-(\\w{4})-(\\w{4})-(\\w{4})-(\\w{12})$/";

    /**
     * @param string $publicKey
     * @return $this
     */
    public function publicKey($publicKey)
    {
        $this->publicKey = $publicKey;
        return $this;
    }

    /**
     * @param string $secretKey
     * @return $this
     */
    public function secretKey($secretKey)
    {
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * @return SdkCredentialsInterface
     */
    protected function getSdkCredentials()
    {
        return new PreviousStaticKeysSdkCredentials($this->secretKey, $this->publicKey);
    }

    /**
     * @return CheckoutApi
     * @throws \Checkout\Tamara\CheckoutArgumentException|\Checkout\Tamara\CheckoutArgumentException
     */
    public function build()
    {
        $this->validatePublicKey($this->publicKey, self::PUBLIC_KEY_PATTERN);
        $this->validateSecretKey($this->secretKey, self::SECRET_KEY_PATTERN);
        $configuration = new CheckoutConfiguration($this->getSdkCredentials(), $this->environment, $this->httpClientBuilder, $this->logger);
        $apiClient = new ApiClient($configuration);
        return new CheckoutApi($apiClient, $configuration);
    }
}
