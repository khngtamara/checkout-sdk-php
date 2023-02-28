<?php

namespace Checkout\Tests\Financial;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Financial\FinancialActionsQuery;
use Checkout\Tamara\Financial\FinancialClient;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\Reports\ReportsQuery;
use Checkout\Tests\UnitTestFixture;

class FinancialClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Financial\FinancialClient
     */
    private $client;

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws CheckoutException
     */
    public function init()
    {
        $this->initMocks(PlatformType::$default);
        $this->client = new \Checkout\Tamara\Financial\FinancialClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldQueryFinancialActions()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("foo");

        $response = $this->client->query(new \Checkout\Tamara\Financial\FinancialActionsQuery());
        $this->assertNotNull($response);
    }
}
