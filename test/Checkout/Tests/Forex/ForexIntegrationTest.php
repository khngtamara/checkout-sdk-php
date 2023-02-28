<?php

namespace Checkout\Tests\Forex;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Forex\QuoteRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class ForexIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws \Checkout\Tamara\CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$default_oauth);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRequestQuote()
    {
        $quoteRequest = new \Checkout\Tamara\Forex\QuoteRequest();
        $quoteRequest->source_currency = Currency::$GBP;
        $quoteRequest->source_amount = 30000;
        $quoteRequest->destination_currency = Currency::$USD;
        $quoteRequest->process_channel_id = "pc_abcdefghijklmnopqrstuvwxyz";

        $quoteResponse = $this->checkoutApi->getForexClient()->requestQuote($quoteRequest);
        $this->assertResponse(
            $quoteResponse,
            "id",
            "source_currency",
            "source_amount",
            "destination_currency",
            "destination_amount",
            "rate",
            "expires_on"
        );
        $this->assertEquals($quoteRequest->source_currency, $quoteResponse["source_currency"]);
        $this->assertEquals($quoteRequest->source_amount, $quoteResponse["source_amount"]);
        $this->assertEquals($quoteRequest->destination_currency, $quoteResponse["destination_currency"]);
    }
}
