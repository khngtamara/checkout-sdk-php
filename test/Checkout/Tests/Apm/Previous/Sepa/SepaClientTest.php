<?php

namespace Checkout\Tests\Apm\Previous\Sepa;

use Checkout\Tamara\Apm\Previous\Sepa\SepaClient;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class SepaClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Apm\Previous\Sepa\SepaClient
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
        $this->initMocks(PlatformType::$previous);
        $this->client = new \Checkout\Tamara\Apm\Previous\Sepa\SepaClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     */
    public function getMandate()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getMandate("mandate_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function cancelMandate()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->cancelMandate("mandate_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function getMandateViaPPro()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getMandateViaPPro("mandate_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     */
    public function cancelMandateViaPPro()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->cancelMandateViaPPro("mandate_id");
        $this->assertNotNull($response);
    }

}
