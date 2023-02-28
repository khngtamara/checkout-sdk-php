<?php

namespace Checkout\Tamara\Reconciliation\Previous;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Common\QueryFilterDateRange;
use Checkout\Tamara\Reconciliation\Previous\ReconciliationQueryPaymentsFilter;

class ReconciliationClient extends Client
{
    const REPORTING_PATH = "reporting";
    const PAYMENTS_PATH = "payments";
    const DOWNLOAD_PATH = "download";
    const STATEMENT_PATH = "statements";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKey);
    }

    /**
     * @param ReconciliationQueryPaymentsFilter $reconciliationQueryPaymentsFilter
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function queryPaymentsReport(ReconciliationQueryPaymentsFilter $reconciliationQueryPaymentsFilter)
    {
        return $this->apiClient->query($this->buildPath(self::REPORTING_PATH, self::PAYMENTS_PATH), $reconciliationQueryPaymentsFilter, $this->sdkAuthorization());
    }

    /**
     * @param $paymentId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function singlePaymentReport($paymentId)
    {
        return $this->apiClient->get($this->buildPath(self::REPORTING_PATH, self::PAYMENTS_PATH, $paymentId), $this->sdkAuthorization());
    }

    /**
     * @param QueryFilterDateRange $dateRange
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function queryStatementsReport(QueryFilterDateRange $dateRange)
    {
        return $this->apiClient->query($this->buildPath(self::REPORTING_PATH, self::STATEMENT_PATH), $dateRange, $this->sdkAuthorization());
    }

    /**
     * @param \Checkout\Tamara\Common\QueryFilterDateRange $dateRange
     * @return array
     * @throws CheckoutApiException
     */
    public function retrieveCsvPaymentReport(QueryFilterDateRange $dateRange)
    {
        return $this->apiClient->query($this->buildPath(self::REPORTING_PATH, self::PAYMENTS_PATH, self::DOWNLOAD_PATH), $dateRange, $this->sdkAuthorization());
    }

    /**
     * @param $statementId
     * @return array
     * @throws CheckoutApiException
     */
    public function retrieveCsvSingleStatementReport($statementId)
    {
        return $this->apiClient->get($this->buildPath(self::REPORTING_PATH, self::STATEMENT_PATH, $statementId, self::PAYMENTS_PATH, self::DOWNLOAD_PATH), $this->sdkAuthorization());
    }

    /**
     * @param \Checkout\Tamara\Common\QueryFilterDateRange $dateRange
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function retrieveCsvStatementsReport(QueryFilterDateRange $dateRange)
    {
        return $this->apiClient->query($this->buildPath(self::REPORTING_PATH, self::STATEMENT_PATH, self::DOWNLOAD_PATH), $dateRange, $this->sdkAuthorization());
    }
}
