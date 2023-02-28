<?php

namespace Checkout\Tests\Tokens;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;
use Checkout\Tamara\Tokens\ApplePayTokenRequest;
use Checkout\Tamara\Tokens\CardTokenRequest;
use Checkout\Tamara\Tokens\GooglePayTokenRequest;
use Checkout\Tamara\Tokens\TokensClient;

class TokensClientTest extends UnitTestFixture
{
    /**
     * @var TokensClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new TokensClient($this->apiClient, $this->configuration);
    }


    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRequestCardToken()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->requestCardToken(new \Checkout\Tamara\Tokens\CardTokenRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRequestWalletToken()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->requestWalletToken(new ApplePayTokenRequest());
        $this->assertNotNull($response);

        $response = $this->client->requestWalletToken(new GooglePayTokenRequest());
        $this->assertNotNull($response);
    }

}
