<?php

namespace Checkout\Tests\Balances;

use Checkout\Tamara\Balances\BalancesClient;
use Checkout\Tamara\Balances\BalancesQuery;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class BalancesClientTest extends UnitTestFixture
{
    /**
     * @var BalancesClient
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
        $this->initMocks(PlatformType::$default_oauth);
        $this->client = new \Checkout\Tamara\Balances\BalancesClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRetrieveEntityBalances()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("response");

        $response = $this->client->retrieveEntityBalances("entity_id", new \Checkout\Tamara\Balances\BalancesQuery());

        $this->assertNotNull($response);
    }
}
