<?php

namespace Checkout\Tests\Payments;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Common\AccountHolder;
use Checkout\Tamara\Payments\AuthorizationRequest;
use Checkout\Tamara\Payments\CaptureRequest;
use Checkout\Tamara\Payments\PaymentsClient;
use Checkout\Tamara\Payments\PaymentsQueryFilter;
use Checkout\Tamara\Payments\Request\PaymentRequest;
use Checkout\Tamara\Payments\Request\PayoutRequest;
use Checkout\Tamara\Payments\Request\Source\RequestProviderTokenSource;
use Checkout\Tamara\Payments\RefundRequest;
use Checkout\Tamara\Payments\VoidRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class PaymentsClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Payments\PaymentsClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$default);
        $this->client = new PaymentsClient($this->apiClient, $this->configuration);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRequestPayment()
    {

        $source = new RequestProviderTokenSource();
        $source->payment_method = "method";
        $source->token = "token";
        $source->account_holder = new AccountHolder();

        $request = new PaymentRequest();
        $request->source = $source;

        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->requestPayment($request);
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRequestPayout()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->requestPayout(new PayoutRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetPaymentsList()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("response");

        $response = $this->client->getPaymentsList(new \Checkout\Tamara\Payments\PaymentsQueryFilter());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetPaymentDetails()
    {

        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->getPaymentDetails("payment_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetPaymentActions()
    {

        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->getPaymentActions("payment_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldCapturePayment()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->capturePayment("payment_id", new \Checkout\Tamara\Payments\CaptureRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRefundPayment()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->refundPayment("payment_id", new \Checkout\Tamara\Payments\RefundRequest());
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
            ->willReturn("response");

        $response = $this->client->voidPayment("payment_id", new VoidRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldIncrementPaymentAuthorization()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->incrementPaymentAuthorization("payment_id", new AuthorizationRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldIncrementPaymentAuthorizationIdempotently()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->incrementPaymentAuthorization(
            "payment_id",
            new AuthorizationRequest(),
            "idempotency_key"
        );
        $this->assertNotNull($response);
    }
}
