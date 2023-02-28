<?php

namespace Checkout\Tamara\Forex;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Forex\QuoteRequest;

class ForexClient extends Client
{
    const FOREX_PATH = "forex/quotes";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$oAuth);
    }

    /**
     * @param QuoteRequest $quoteRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function requestQuote(QuoteRequest $quoteRequest)
    {
        return $this->apiClient->post(self::FOREX_PATH, $quoteRequest, $this->sdkAuthorization());
    }
}
