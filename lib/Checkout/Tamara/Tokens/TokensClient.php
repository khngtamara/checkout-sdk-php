<?php

namespace Checkout\Tamara\Tokens;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Tokens\CardTokenRequest;
use Checkout\Tamara\Tokens\WalletTokenRequest;

class TokensClient extends Client
{
    const TOKENS_PATH = "tokens";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$publicKey);
    }

    /**
     * @param CardTokenRequest $cardTokenRequest
     * @return array
     * @throws CheckoutApiException
     */
    public function requestCardToken(CardTokenRequest $cardTokenRequest)
    {
        return $this->apiClient->post(self::TOKENS_PATH, $cardTokenRequest, $this->sdkAuthorization());
    }

    /**
     * @param WalletTokenRequest $walletTokenRequest
     * @return array
     * @throws CheckoutApiException
     */
    public function requestWalletToken(WalletTokenRequest $walletTokenRequest)
    {
        return $this->apiClient->post(self::TOKENS_PATH, $walletTokenRequest, $this->sdkAuthorization());
    }

}
