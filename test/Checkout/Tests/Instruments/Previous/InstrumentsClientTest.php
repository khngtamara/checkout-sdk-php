<?php

namespace Checkout\Tests\Instruments\Previous;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Instruments\Previous\CreateInstrumentRequest;
use Checkout\Tamara\Instruments\Previous\InstrumentsClient;
use Checkout\Tamara\Instruments\Previous\UpdateInstrumentRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class InstrumentsClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Instruments\Previous\InstrumentsClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new \Checkout\Tamara\Instruments\Previous\InstrumentsClient($this->apiClient, $this->configuration);
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

        $response = $this->client->create(new \Checkout\Tamara\Instruments\Previous\CreateInstrumentRequest());
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


        $response = $this->client->update("instrument_id", new \Checkout\Tamara\Instruments\Previous\UpdateInstrumentRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldDeleteInstruments()
    {
        $this->apiClient->method("delete")
            ->willReturn("foo");

        $response = $this->client->delete("instrument_id");
        $this->assertNotNull($response);
    }
}
