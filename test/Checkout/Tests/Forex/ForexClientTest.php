<?php

namespace Checkout\Tests\Forex;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Forex\ForexClient;
use Checkout\Tamara\Forex\QuoteRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class ForexClientTest extends UnitTestFixture
{
    /**
     * @var ForexClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new ForexClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRequestQuote()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->requestQuote(new QuoteRequest());
        $this->assertNotNull($response);
    }
}
