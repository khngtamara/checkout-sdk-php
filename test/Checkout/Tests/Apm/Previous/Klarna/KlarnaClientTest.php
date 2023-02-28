<?php

namespace Checkout\Tests\Apm\Previous\Klarna;

use Checkout\Tamara\Apm\Previous\Klarna\CreditSessionRequest;
use Checkout\Tamara\Apm\Previous\Klarna\KlarnaClient;
use Checkout\Tamara\Apm\Previous\Klarna\OrderCaptureRequest;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Payments\VoidRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class KlarnaClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Apm\Previous\Klarna\KlarnaClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new KlarnaClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateCreditSession()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->createCreditSession(new \Checkout\Tamara\Apm\Previous\Klarna\CreditSessionRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetCreditSession()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getCreditSession("session_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function capturePayment()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->capturePayment("payment_id", new OrderCaptureRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldVoidPayment()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->voidPayment("payment_id", new VoidRequest());
        $this->assertNotNull($response);
    }

}
