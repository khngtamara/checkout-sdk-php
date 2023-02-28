<?php

namespace Checkout\Tests\Tokens\Previous;

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
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$previous);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateCardToken()
    {
        $cardTokenRequest = new CardTokenRequest();
        $cardTokenRequest->name = "Mr. Test";
        $cardTokenRequest->number = "4242424242424242";
        $cardTokenRequest->expiry_year = 2025;
        $cardTokenRequest->expiry_month = 6;
        $cardTokenRequest->cvv = "100";
        $cardTokenRequest->billing_address = $this->getAddress();
        $cardTokenRequest->phone = $this->getPhone();

        $this->assertResponse(
            $this->previousApi->getTokensClient()->requestCardToken($cardTokenRequest),
            "token",
            "type",
            "expires_on",
            "billing_address.address_line1",
            "billing_address.address_line2",
            "billing_address.city",
            "billing_address.state",
            "billing_address.zip",
            "billing_address.country",
            "phone.country_code",
            "phone.number",
            "expiry_month",
            "expiry_year",
            "name",
            "last4",
            "bin"
            //"card_type",
            //"card_category",
            //"issuer",
            //"issuer_country",
            //"product_id",
            //"product_type"
        );
    }

}
