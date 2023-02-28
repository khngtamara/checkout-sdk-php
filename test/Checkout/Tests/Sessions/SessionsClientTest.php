<?php

namespace Checkout\Tests\Sessions;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\Sessions\Channel\AppSession;
use Checkout\Tamara\Sessions\SessionRequest;
use Checkout\Tamara\Sessions\SessionsClient;
use Checkout\Tamara\Sessions\ThreeDsMethodCompletionRequest;
use Checkout\Tests\UnitTestFixture;

class SessionsClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Sessions\SessionsClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$default_oauth);
        $this->client = new \Checkout\Tamara\Sessions\SessionsClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRequestSessionCreateSessionOkResponse()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->requestSession(new \Checkout\Tamara\Sessions\SessionRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldGetSessionDetails()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->getSessionDetails("id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldGetSessionDetailsSessionSecret()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->getSessionDetails("id", "sessionSecr3t");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldUpdateSessionDetails()
    {
        $this->apiClient
            ->method("put")
            ->willReturn("response");

        $response = $this->client->updateSession("id", new AppSession());
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldUpdateSessionDetailsSessionSecret()
    {
        $this->apiClient
            ->method("put")
            ->willReturn("response");

        $response = $this->client->updateSession("id", new AppSession(), "sessionSecr3t");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldCompleteSession()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->completeSession("id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldCompleteSessionSessionSecret()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->completeSession("id", "sessionSecr3t");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldUpdate3dsMethodCompletionIndicator()
    {
        $this->apiClient
            ->method("put")
            ->willReturn("response");

        $response = $this->client->updateThreeDsMethodCompletionIndicator("id", new \Checkout\Tamara\Sessions\ThreeDsMethodCompletionRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function shouldUpdate3dsMethodCompletionIndicatorSessionSecret()
    {
        $this->apiClient
            ->method("put")
            ->willReturn("response");

        $response = $this->client->updateThreeDsMethodCompletionIndicator("id", new \Checkout\Tamara\Sessions\ThreeDsMethodCompletionRequest(), "sessionSecr3t");
        $this->assertNotNull($response);
    }

}
