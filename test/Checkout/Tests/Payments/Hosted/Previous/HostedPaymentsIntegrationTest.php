<?php

namespace Checkout\Tests\Payments\Hosted\Previous;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Common\Product;
use Checkout\Tamara\Payments\BillingInformation;
use Checkout\Tamara\Payments\Hosted\HostedPaymentsSessionRequest;
use Checkout\Tamara\Payments\PaymentRecipient;
use Checkout\Tamara\Payments\ProcessingSettings;
use Checkout\Tamara\Payments\RiskRequest;
use Checkout\Tamara\Payments\ShippingDetails;
use Checkout\Tamara\Payments\ThreeDsRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class HostedPaymentsIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$previous);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldCreateAndGetHostedPaymentsPageDetails()
    {

        $request = $this->createHostedPaymentsRequest();

        $response = $this->previousApi->getHostedPaymentsClient()->createHostedPaymentsPageSession($request);

        $this->assertResponse(
            $response,
            "id",
            "reference",
            "_links",
            "_links.self",
            "_links.redirect"
        );

        $getResponse = $this->previousApi->getHostedPaymentsClient()->getHostedPaymentsPageDetails($response["id"]);

        $this->assertResponse(
            $getResponse,
            "id",
            "reference",
            "status",
            "amount",
            "billing",
            "currency",
            "customer",
            "description",
            "failure_url",
            "success_url",
            "cancel_url",
            "products",
            "_links",
            "_links.self",
            "_links.redirect"
        );
    }

    private function createHostedPaymentsRequest()
    {
        $customerRequest = new CustomerRequest();
        $customerRequest->email = $this->randomEmail();
        $customerRequest->name = "Customer";

        $billingInformation = new BillingInformation();
        $billingInformation->address = $this->getAddress();
        $billingInformation->phone = $this->getPhone();

        $shippingDetails = new ShippingDetails();
        $shippingDetails->address = $this->getAddress();
        $shippingDetails->phone = $this->getPhone();

        $recipient = new PaymentRecipient();
        $recipient->account_number = "1234567";
        $recipient->dob = "1985-05-15";
        $recipient->first_name = "Mr.";
        $recipient->last_name = "Testing";
        $recipient->zip = "12345";
        $recipient->country = Country::$ES;

        $product = new Product();
        $product->name = "Gold Necklace";
        $product->quantity = 1;
        $product->price = 10;

        $products = array($product);

        $theeDsRequest = new ThreeDsRequest();
        $theeDsRequest->enabled = false;
        $theeDsRequest->attempt_n3d = false;

        $processing = new ProcessingSettings();
        $processing->aft = true;

        $risk = new RiskRequest();
        $risk->enabled = false;

        $hostedPaymentRequest = new HostedPaymentsSessionRequest();
        $hostedPaymentRequest->amount = 1000;
        $hostedPaymentRequest->reference = "reference";
        $hostedPaymentRequest->currency = Currency::$GBP;
        $hostedPaymentRequest->description = "Payment for Gold Necklace";
        $hostedPaymentRequest->customer = $customerRequest;
        $hostedPaymentRequest->shipping = $shippingDetails;
        $hostedPaymentRequest->billing = $billingInformation;
        $hostedPaymentRequest->recipient = $recipient;
        $hostedPaymentRequest->processing = $processing;
        $hostedPaymentRequest->products = $products;
        $hostedPaymentRequest->risk = $risk;
        $hostedPaymentRequest->success_url = "https://example.com/payments/success";
        $hostedPaymentRequest->cancel_url = "https://example.com/payments/cancel";
        $hostedPaymentRequest->failure_url = "https://example.com/payments/failure";
        $hostedPaymentRequest->locale = "en-GB";
        $hostedPaymentRequest->three_ds = $theeDsRequest;
        $hostedPaymentRequest->capture = true;

        return $hostedPaymentRequest;
    }

}
