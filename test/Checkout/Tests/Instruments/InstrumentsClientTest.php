<?php

namespace Checkout\Tests\Instruments;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\AccountHolderType;
use Checkout\Tamara\Instruments\Create\CreateBankAccountInstrumentRequest;
use Checkout\Tamara\Instruments\Get\BankAccountFieldQuery;
use Checkout\Tamara\Instruments\Get\PaymentNetwork;
use Checkout\Tamara\Instruments\InstrumentsClient;
use Checkout\Tamara\Instruments\Update\UpdateCardInstrumentRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class InstrumentsClientTest extends UnitTestFixture
{
    /**
     * @var InstrumentsClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$default);
        $this->client = new InstrumentsClient($this->apiClient, $this->configuration);
    }


    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldCreateInstrument()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->create(new CreateBankAccountInstrumentRequest());
        $this->assertNotNull($response);
    }


    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetInstrument()
    {
        $this->apiClient->method("get")
            ->willReturn("foo");


        $response = $this->client->get("instrument_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldUpdateInstrument()
    {
        $this->apiClient->method("patch")
            ->willReturn("foo");


        $response = $this->client->update("instrument_id", new UpdateCardInstrumentRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldDeleteInstruments()
    {
        $this->apiClient->method("delete")
            ->willReturn("foo");

        $response = $this->client->delete("instrument_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetBankAccountFieldFormatting()
    {
        $this->apiClient->method("query")
            ->willReturn("foo");

        $request = new BankAccountFieldQuery();
        $request->payment_network = PaymentNetwork::$local;
        $request->account_holder_type = AccountHolderType::$individual;

        $response = $this->client->getBankAccountFieldFormatting(Country::$GB, Currency::$GBP, $request);
        $this->assertNotNull($response);
    }
}
