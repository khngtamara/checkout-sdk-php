<?php

namespace Checkout\Tests\Sources\Previous;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\Sources\Previous\SepaSourceRequest;
use Checkout\Tamara\Sources\Previous\SourceData;
use Checkout\Tests\SandboxTestFixture;

class SourcesIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws \Checkout\Tamara\CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$previous);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateSepaSource()
    {
        $this->markTestSkipped("unstable");
        $sourceData = new SourceData();
        $sourceData->first_name = "Marcus";
        $sourceData->last_name = "Barrilius Maximus";
        $sourceData->account_iban = "DE68100100101234567895";
        $sourceData->bic = "PBNKDEFFXXX";
        $sourceData->billing_descriptor = ".NET SDK test";
        $sourceData->mandate_type = "single";

        $sepaSourceRequest = new SepaSourceRequest();
        $sepaSourceRequest->billing_address = $this->getAddress();
        $sepaSourceRequest->phone = $this->getPhone();
        $sepaSourceRequest->reference = ".NET SDK test";
        $sepaSourceRequest->source_data = $sourceData;

        $this->assertResponse(
            $this->previousApi->getSourcesClient()->createSepaSource($sepaSourceRequest),
            "type",
            "customer.id",
            "id",
            "_links.sepa:mandate-cancel",
            "_links.sepa:mandate-get",
            "response_code",
            "response_data.mandate_reference"
        );
    }

}
