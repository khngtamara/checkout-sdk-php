<?php

namespace Checkout\Tests\Payments\Hosted;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Common\Product;
use Checkout\Tamara\Payments\BillingDescriptor;
use Checkout\Tamara\Payments\BillingInformation;
use Checkout\Tamara\Payments\Hosted\HostedPaymentsSessionRequest;
use Checkout\Tamara\Payments\PaymentRecipient;
use Checkout\Tamara\Payments\PaymentType;
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
     * @throws CheckoutArgumentException
     * @throws CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$default);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateAndGetHostedPaymentsPageDetails()
    {
        $request = $this->createHostedPaymentsRequest();

        $response = $this->checkoutApi->getHostedPaymentsClient()->createHostedPaymentsPageSession($request);

        $this->assertResponse(
            $response,
            "id",
            "reference",
            "_links",
            "_links.self",
            "_links.redirect",
            "warnings"
        );
        foreach ($response["warnings"] as $warning) {
            $this->assertResponse(
                $warning,
                "code",
                "value",
                "description"
            );
        }

        $getResponse = $this->checkoutApi->getHostedPaymentsClient()->getHostedPaymentsPageDetails($response["id"]);

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

        $billingDescriptor = new BillingDescriptor();
        $billingDescriptor->city = "London";
        $billingDescriptor->name = "Awesome name";

        $hostedPaymentRequest = new \Checkout\Tamara\Payments\Hosted\HostedPaymentsSessionRequest();
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
        $hostedPaymentRequest->payment_type = PaymentType::$regular;
        $hostedPaymentRequest->billing_descriptor = $billingDescriptor;
        $hostedPaymentRequest->allow_payment_methods = array(PaymentSourceType::$card, PaymentSourceType::$ideal);

        return $hostedPaymentRequest;
    }

}
