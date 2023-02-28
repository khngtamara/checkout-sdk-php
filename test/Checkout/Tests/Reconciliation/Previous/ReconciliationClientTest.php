<?php

namespace Checkout\Tests\Reconciliation\Previous;

use Checkout\Tamara\Common\QueryFilterDateRange;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\Reconciliation\Previous\ReconciliationClient;
use Checkout\Tamara\Reconciliation\Previous\ReconciliationQueryPaymentsFilter;
use Checkout\Tests\UnitTestFixture;

class ReconciliationClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Reconciliation\Previous\ReconciliationClient $client
     */
    private $client;

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws CheckoutException
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new ReconciliationClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     */
    public function shouldQueryPaymentsReport()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("foo");

        $response = $this->client->queryPaymentsReport(new \Checkout\Tamara\Reconciliation\Previous\ReconciliationQueryPaymentsFilter());
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldSinglePaymentReport()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->singlePaymentReport("payment_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldQueryStatementsReport()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("foo");

        $response = $this->client->queryStatementsReport(new QueryFilterDateRange());
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldRetrieveCsvPaymentReport()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("foo");

        $response = $this->client->retrieveCsvPaymentReport(new QueryFilterDateRange());
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldRetrieveCsvSingleStatementReport()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->retrieveCsvSingleStatementReport("statement_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldRetrieveCsvStatementsReport()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("foo");

        $response = $this->client->retrieveCsvStatementsReport(new QueryFilterDateRange());
        $this->assertNotNull($response);
    }
}
