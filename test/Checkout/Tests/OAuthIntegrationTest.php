<?php

namespace Checkout\Tests;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutSdk;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\MarketplaceData;
use Checkout\Tamara\Environment;
use Checkout\Tamara\Payments\Request\PaymentRequest;
use Checkout\Tamara\Payments\Request\Source\RequestCardSource;
use Checkout\Tamara\Payments\Sender\PaymentIndividualSender;
use Checkout\Tamara\PlatformType;
use Exception;

class OAuthIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws
     */
    public function before()
    {
        $this->init(PlatformType::$default_oauth);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldMakePaymentWithOAuth()
    {

        $requestCardSource = new RequestCardSource();
        $requestCardSource->name = TestCardSource::$VisaName;
        $requestCardSource->number = TestCardSource::$VisaNumber;
        $requestCardSource->expiry_year = TestCardSource::$VisaExpiryYear;
        $requestCardSource->expiry_month = TestCardSource::$VisaExpiryMonth;
        $requestCardSource->cvv = TestCardSource::$VisaCvv;

        $paymentIndividualSender = new PaymentIndividualSender();
        $paymentIndividualSender->fist_name = "Mr";
        $paymentIndividualSender->last_name = "Test";
        $paymentIndividualSender->address = $this->getAddress();

        $marketplace = new MarketplaceData();
        $marketplace->sub_entity_id = "ent_ocw5i74vowfg2edpy66izhts2u";

        $paymentRequest = new PaymentRequest();
        $paymentRequest->source = $requestCardSource;
        $paymentRequest->capture = false;
        $paymentRequest->reference = uniqid();
        $paymentRequest->amount = 10;
        $paymentRequest->currency = Currency::$EUR;
        $paymentRequest->processing_channel_id = "pc_a6dabcfa2o3ejghb3sjuotdzzy";
        $paymentRequest->marketplace = $marketplace;
        $paymentRequest->sender = $paymentIndividualSender;

        $paymentResponse = $this->checkoutApi->getPaymentsClient()->requestPayment($paymentRequest);

        $this->assertResponse($paymentResponse, "id");
    }

    /**
     * @test
     */
    public function shouldFailInitAuthorizationInvalidCredentials()
    {

        try {
            CheckoutSdk::builder()
                ->oAuth()
                ->clientCredentials("fake", "fake")
                ->environment(Environment::sandbox())
                ->build();
            $this->fail("shouldn't get here");
        } catch (Exception $e) {
            $this->assertEquals("Client error: `POST https://access.sandbox.checkout.com/connect/token` resulted in a `400 Bad Request` response:\n{\"error\":\"invalid_client\"}\n", $e->getMessage());
        }
    }

    /**
     * @test
     */
    public function shouldFailInitAuthorizationCustomFakeAuthorizationUri()
    {
        try {
            CheckoutSdk::builder()
                ->oAuth()
                ->clientCredentials("fake", "fake")
                ->authorizationUri("https://test.checkout.com")
                ->environment(Environment::sandbox())
                ->build();
            $this->fail("shouldn't get here");
        } catch (Exception $e) {
            $this->assertTrue(strpos($e->getMessage(), "cURL error 6: Could not resolve host: test.checkout.com") !== false);
        }
    }

}
