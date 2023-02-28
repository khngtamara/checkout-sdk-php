<?php

namespace Checkout\Tests\Payments\Hosted;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Payments\Hosted\HostedPaymentsClient;
use Checkout\Tamara\Payments\Hosted\HostedPaymentsSessionRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class HostedPaymentsClientTest extends UnitTestFixture
{
    /**
     * @var HostedPaymentsClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new HostedPaymentsClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetHostedPaymentsPageDetails()
    {

        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->getHostedPaymentsPageDetails("id");
        $this->assertNotNull($response);
    }


    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateHostedPaymentsPageSession()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->createHostedPaymentsPageSession(new HostedPaymentsSessionRequest());
        $this->assertNotNull($response);
    }

}
