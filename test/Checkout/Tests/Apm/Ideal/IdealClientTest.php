<?php

namespace Checkout\Tests\Apm\Ideal;

use Checkout\Tamara\Apm\Ideal\IdealClient;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class IdealClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Apm\Ideal\IdealClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new IdealClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetInfo()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getInfo();
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetIssuers()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getIssuers();
        $this->assertNotNull($response);
    }
}
