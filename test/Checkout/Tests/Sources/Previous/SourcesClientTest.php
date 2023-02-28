<?php

namespace Checkout\Tests\Sources\Previous;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\Sources\Previous\SepaSourceRequest;
use Checkout\Tamara\Sources\Previous\SourcesClient;
use Checkout\Tests\UnitTestFixture;

class SourcesClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Sources\Previous\SourcesClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new \Checkout\Tamara\Sources\Previous\SourcesClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateSepaSource()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->createSepaSource(new \Checkout\Tamara\Sources\Previous\SepaSourceRequest());
        $this->assertNotNull($response);
    }

}
