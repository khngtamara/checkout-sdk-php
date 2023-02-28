<?php

namespace Checkout\Tamara\Balances;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Balances\BalancesQuery;

class BalancesClient extends Client
{
    const BALANCES_PATH = "balances";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKeyOrOAuth);
    }

    /**
     * @param $entityId
     * @param BalancesQuery $balancesQuery
     * @return array
     * @throws CheckoutApiException
     */
    public function retrieveEntityBalances($entityId, BalancesQuery $balancesQuery)
    {
        return $this->apiClient->query(
            $this->buildPath(self::BALANCES_PATH, $entityId),
            $balancesQuery,
            $this->sdkAuthorization()
        );
    }
}
