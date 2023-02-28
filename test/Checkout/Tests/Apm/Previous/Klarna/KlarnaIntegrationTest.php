<?php

namespace Checkout\Tests\Apm\Previous\Klarna;

use Checkout\Tamara\Apm\Previous\Klarna\CreditSessionRequest;
use Checkout\Tamara\Apm\Previous\Klarna\KlarnaProduct;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class KlarnaIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws CheckoutAuthorizationException
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
    public function shouldCreateAndGetKlarnaSession()
    {
        $klarnaProduct = new KlarnaProduct();
        $klarnaProduct->name = "Brown leather belt";
        $klarnaProduct->quantity = 1;
        $klarnaProduct->unit_price = 1000;
        $klarnaProduct->tax_rate = 0;
        $klarnaProduct->total_amount = 1000;
        $klarnaProduct->total_tax_amount = 0;

        $creditSessionRequest = new \Checkout\Tamara\Apm\Previous\Klarna\CreditSessionRequest();
        $creditSessionRequest->purchase_country = Country::$GB;
        $creditSessionRequest->currency = Currency::$GBP;
        $creditSessionRequest->locale = "en-GB";
        $creditSessionRequest->amount = 1000;
        $creditSessionRequest->tax_amount = 1;
        $creditSessionRequest->products = array($klarnaProduct);

        $creditSessionResponse = $this->previousApi->getKlarnaClient()->createCreditSession($creditSessionRequest);

        $this->assertResponse(
            $creditSessionResponse,
            "session_id",
            "client_token",
            "payment_method_categories"
        );


        foreach ($creditSessionResponse["payment_method_categories"] as $paymentMethodCategory) {
            $this->assertResponse(
                $paymentMethodCategory,
                "name",
                "identifier",
                "asset_urls"
            );
        }

        $creditSession = $this->previousApi->getKlarnaClient()->getCreditSession($creditSessionResponse["session_id"]);

        $this->assertResponse(
            $creditSession,
            "client_token",
            "purchase_country",
            "currency",
            "locale",
            "amount",
            "tax_amount",
            "products"
        );

        foreach ($creditSession["products"] as $creditSessionProduct) {
            $this->assertResponse(
                $creditSessionProduct,
                "name",
                "quantity",
                "unit_price",
                "total_amount"
            );
        }
    }
}
