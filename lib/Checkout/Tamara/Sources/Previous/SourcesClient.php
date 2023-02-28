<?php

namespace Checkout\Tamara\Sources\Previous;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Sources\Previous\SepaSourceRequest;

class SourcesClient extends Client
{

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKey);
    }

    /**
     * @param SepaSourceRequest $sepaSourceRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function createSepaSource(SepaSourceRequest $sepaSourceRequest)
    {
        return $this->apiClient->post("sources", $sepaSourceRequest, $this->sdkAuthorization());
    }

}
