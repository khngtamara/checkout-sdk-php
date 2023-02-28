<?php

namespace Checkout\Tests\Metadata;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Metadata\Card\CardMetadataRequest;
use Checkout\Tamara\Metadata\MetadataClient;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class MetadataClientTest extends UnitTestFixture
{
    /**
     * @var MetadataClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$default);
        $this->client = new MetadataClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRequestCardMetadata()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->requestCardMetadata(new CardMetadataRequest());
        $this->assertNotNull($response);
    }
}
