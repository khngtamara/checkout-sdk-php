<?php

namespace Checkout\Tests\Payments\Links;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\AmountAllocations;
use Checkout\Tamara\Common\Commission;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Common\Product;
use Checkout\Tamara\Payments\BillingDescriptor;
use Checkout\Tamara\Payments\BillingInformation;
use Checkout\Tamara\Payments\Links\PaymentLinkRequest;
use Checkout\Tamara\Payments\PaymentRecipient;
use Checkout\Tamara\Payments\PaymentType;
use Checkout\Tamara\Payments\ProcessingSettings;
use Checkout\Tamara\Payments\RiskRequest;
use Checkout\Tamara\Payments\ShippingDetails;
use Checkout\Tamara\Payments\ThreeDsRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class PaymentLinksIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws \Checkout\Tamara\CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$default);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateAndGetPaymentLink()
    {
        $request = $this->createPaymentLinkRequest();

        $commission = new Commission();
        $commission->amount = 1;
        $commission->percentage = 0.1;

        $allocations = new AmountAllocations();
        $allocations->id = "ent_sdioy6bajpzxyl3utftdp7legq";
        $allocations->amount=100;
        $allocations->reference = uniqid();
        $allocations->commission = $commission;

        $request->amount_allocations = array($allocations);

        $response = $this->checkoutApi->getPaymentLinksClient()->createPaymentLink($request);

        $this->assertResponse(
            $response,
            "id",
            "reference",
            "expires_on",
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

        $getResponse = $this->checkoutApi->getPaymentLinksClient()->getPaymentLink($response["id"]);

        $this->assertResponse(
            $getResponse,
            "id",
            "reference",
            "status",
            "amount",
            "billing",
            "currency",
            "billing",
            "customer",
            "created_on",
            "expires_on",
            "description",
            "products",
            "_links",
            "_links.self",
            "_links.redirect"
        );
    }

    private function createPaymentLinkRequest()
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

        $paymentLinkRequest = new PaymentLinkRequest();
        $paymentLinkRequest->amount = 200;
        $paymentLinkRequest->reference = "reference";
        $paymentLinkRequest->currency = Currency::$GBP;
        $paymentLinkRequest->description = "Payment for Gold Necklace";
        $paymentLinkRequest->customer = $customerRequest;
        $paymentLinkRequest->shipping = $shippingDetails;
        $paymentLinkRequest->billing = $billingInformation;
        $paymentLinkRequest->recipient = $recipient;
        $paymentLinkRequest->processing = $processing;
        $paymentLinkRequest->products = $products;
        $paymentLinkRequest->risk = $risk;
        $paymentLinkRequest->locale = "en-GB";
        $paymentLinkRequest->three_ds = $theeDsRequest;
        $paymentLinkRequest->capture = true;
        $paymentLinkRequest->expires_in = 604800;
        $paymentLinkRequest->payment_type = PaymentType::$regular;
        $paymentLinkRequest->billing_descriptor = $billingDescriptor;
        $paymentLinkRequest->allow_payment_methods = array(PaymentSourceType::$card, PaymentSourceType::$ideal);

        return $paymentLinkRequest;
    }

}
