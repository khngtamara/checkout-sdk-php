<?php

namespace Checkout\Tamara\Reports;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Reports\ReportsQuery;

class ReportsClient extends Client
{
    const REPORTS_PATH = "reports";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKeyOrOAuth);
    }

    /**
     * @param ReportsQuery $filter
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function getAllReports(ReportsQuery $filter)
    {
        return $this->apiClient->query(self::REPORTS_PATH, $filter, $this->sdkAuthorization());
    }

    /**
     * @param $reportId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function getReportDetails($reportId)
    {
        return $this->apiClient->get($this->buildPath(self::REPORTS_PATH, $reportId), $this->sdkAuthorization());
    }
}
