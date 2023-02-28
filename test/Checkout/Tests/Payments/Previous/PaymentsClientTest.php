<?php

namespace Checkout\Tests\Payments\Previous;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Payments\PaymentsQueryFilter;
use Checkout\Tamara\Payments\Previous\CaptureRequest;
use Checkout\Tamara\Payments\Previous\PaymentRequest;
use Checkout\Tamara\Payments\Previous\PaymentsClient;
use Checkout\Tamara\Payments\Previous\PayoutRequest;
use Checkout\Tamara\Payments\RefundRequest;
use Checkout\Tamara\Payments\VoidRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class PaymentsClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Payments\Previous\PaymentsClient
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
        $this->client = new PaymentsClient($this->apiClient, $this->configuration);
    }


    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRequestPayment()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->requestPayment(new PaymentRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRequestPaymentCustomSource()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $customSource = new CustomSource();
        $customSource->amount = 10;
        $customSource->currency = Currency::$USD;

        $request = new PaymentRequest();
        $request->source = $customSource;
        $response = $this->client->requestPayment($request);
        $this->assertNotNull($response);
    }


    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRequestPayout()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->requestPayout(new \Checkout\Tamara\Payments\Previous\PayoutRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetPaymentsList()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("response");

        $response = $this->client->getPaymentsList(new PaymentsQueryFilter());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetPaymentDetails()
    {

        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getPaymentDetails("payment_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetPaymentActions()
    {

        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getPaymentActions("payment_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCapturePayment()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->capturePayment("payment_id", new \Checkout\Tamara\Payments\Previous\CaptureRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRefundPayment()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->refundPayment("payment_id", new RefundRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
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
