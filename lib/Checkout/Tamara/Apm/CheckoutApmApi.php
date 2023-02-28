<?php

namespace Checkout\Tamara\Apm;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\Apm\Ideal\IdealClient;
use Checkout\Tamara\Apm\Previous\Klarna\KlarnaClient;
use Checkout\Tamara\Apm\Previous\Sepa\SepaClient;
use Checkout\Tamara\CheckoutConfiguration;

class CheckoutApmApi
{

    private $idealClient;
    private $klarnaClient;
    private $sepaClient;

    /**
     * @param \Checkout\Tamara\ApiClient $apiClient
     * @param \Checkout\Tamara\CheckoutConfiguration $configuration
     */
    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        $this->idealClient = new IdealClient($apiClient, $configuration);
        $this->klarnaClient = new KlarnaClient($apiClient, $configuration);
        $this->sepaClient = new SepaClient($apiClient, $configuration);
    }

    /**
     * @return \Checkout\Tamara\Apm\Ideal\IdealClient
     */
    public function getIdealClient()
    {
        return $this->idealClient;
    }

    /**
     * @return \Checkout\Tamara\Apm\Previous\Klarna\KlarnaClient
     */
    public function getKlarnaClient()
    {
        return $this->klarnaClient;
    }

    /**
     * @return \Checkout\Tamara\Apm\Previous\Sepa\SepaClient
     */
    public function getSepaClient()
    {
        return $this->sepaClient;
    }
}
