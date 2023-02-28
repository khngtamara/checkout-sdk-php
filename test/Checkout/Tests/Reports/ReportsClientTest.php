<?php

namespace Checkout\Tests\Reports;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\Reports\ReportsClient;
use Checkout\Tamara\Reports\ReportsQuery;
use Checkout\Tests\UnitTestFixture;

class ReportsClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Reports\ReportsClient
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
        $this->initMocks(PlatformType::$default);
        $this->client = new \Checkout\Tamara\Reports\ReportsClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetAllReports()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("foo");

        $response = $this->client->getAllReports(new ReportsQuery());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetReportDetails()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getReportDetails("report_id");
        $this->assertNotNull($response);
    }
}
