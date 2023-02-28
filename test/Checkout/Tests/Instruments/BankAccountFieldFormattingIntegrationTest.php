<?php

namespace Checkout\Tests\Instruments;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\AccountHolderType;
use Checkout\Tamara\Instruments\Get\BankAccountFieldQuery;
use Checkout\Tamara\Instruments\Get\PaymentNetwork;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class BankAccountFieldFormattingIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$default_oauth);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldFailGetBankAccountFieldFormattingWhenNoOAuthIsProvided()
    {
        $request = new BankAccountFieldQuery();
        $request->account_holder_type = AccountHolderType::$individual;
        $request->payment_network = PaymentNetwork::$local;

        $response = $this->checkoutApi->getInstrumentsClient()->getBankAccountFieldFormatting(Country::$GB, Currency::$GBP, $request);

        $this->assertResponse($response, "sections");

        foreach ($response["sections"] as $section) {
            $this->assertResponse($section, "name", "fields");
            $this->assertNotEmpty($section["fields"]);

            foreach ($section["fields"] as $field) {
                $this->assertResponse($field, "id", "display", "type");
            }
        }
    }
}
