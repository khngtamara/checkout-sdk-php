<?php

namespace Checkout\Tests\Tokens;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;
use Checkout\Tamara\Tokens\CardTokenRequest;

class TokensIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws \Checkout\Tamara\CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$default);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldCreateCardToken()
    {
        $cardTokenRequest = new \Checkout\Tamara\Tokens\CardTokenRequest();
        $cardTokenRequest->name = "Mr. Test";
        $cardTokenRequest->number = "4242424242424242";
        $cardTokenRequest->expiry_year = 2025;
        $cardTokenRequest->expiry_month = 6;
        $cardTokenRequest->cvv = "100";
        $cardTokenRequest->billing_address = $this->getAddress();
        $cardTokenRequest->phone = $this->getPhone();

        $this->assertResponse(
            $this->checkoutApi->getTokensClient()->requestCardToken($cardTokenRequest),
            "token",
            "type",
            "expires_on",
            "expiry_month",
            "expiry_year",
            "name",
            "scheme",
            "last4",
            "bin",
            "card_type",
            "card_category",
            //"issuer",
            "issuer_country",
            "product_id",
            "product_type"
        );
    }

}
