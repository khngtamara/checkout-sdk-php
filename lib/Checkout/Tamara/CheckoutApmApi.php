<?php

namespace Checkout\Tamara;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\Apm\Ideal\IdealClient;
use Checkout\Tamara\CheckoutConfiguration;

class CheckoutApmApi
{
    private $idealClient;

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        $this->idealClient = new IdealClient($apiClient, $configuration);
    }

    /**
     * @return IdealClient
     */
    public function getIdealClient()
    {
        return $this->idealClient;
    }
}
