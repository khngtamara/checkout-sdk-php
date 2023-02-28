<?php

namespace Checkout\Tamara\Apm\Ideal;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;

class IdealClient extends Client
{

    const IDEAL_EXTERNAL_PATH = "ideal-external";
    const ISSUERS_PATH = "issuers";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKey);
    }

    /**
     * @return array
     * @throws CheckoutApiException
     */
    public function getInfo()
    {
        return $this->apiClient->get(self::IDEAL_EXTERNAL_PATH, $this->sdkAuthorization());
    }

    /**
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function getIssuers()
    {
        return $this->apiClient->get($this->buildPath(self::IDEAL_EXTERNAL_PATH, self::ISSUERS_PATH), $this->sdkAuthorization());
    }
}
