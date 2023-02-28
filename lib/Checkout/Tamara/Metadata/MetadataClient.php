<?php

namespace Checkout\Tamara\Metadata;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Metadata\Card\CardMetadataRequest;

class MetadataClient extends Client
{
    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKeyOrOAuth);
    }

    /**
     * @param CardMetadataRequest $cardMetadataRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function requestCardMetadata(CardMetadataRequest $cardMetadataRequest)
    {
        return $this->apiClient->post(
            "metadata/card",
            $cardMetadataRequest,
            $this->sdkAuthorization()
        );
    }

}
