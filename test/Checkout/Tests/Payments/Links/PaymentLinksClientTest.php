<?php

namespace Checkout\Tests\Payments\Links;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Payments\Links\PaymentLinkRequest;
use Checkout\Tamara\Payments\Links\PaymentLinksClient;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class PaymentLinksClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Payments\Links\PaymentLinksClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new \Checkout\Tamara\Payments\Links\PaymentLinksClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetPaymentLink()
    {

        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->getPaymentLink("id");
        $this->assertNotNull($response);
    }


    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreatePaymentLink()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->createPaymentLink(new \Checkout\Tamara\Payments\Links\PaymentLinkRequest());
        $this->assertNotNull($response);
    }

}
