<?php

namespace Checkout\Tamara\Financial;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Financial\FinancialActionsQuery;

class FinancialClient extends Client
{
    const FINANCIAL_ACTIONS_PATH = "financial-actions";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKeyOrOAuth);
    }

    /**
     * @param FinancialActionsQuery $filter
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function query(FinancialActionsQuery $filter)
    {
        return $this->apiClient->query(self::FINANCIAL_ACTIONS_PATH, $filter, $this->sdkAuthorization());
    }
}
