<?php

namespace Checkout\Tests\Metadata;

use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\CheckoutSdk;
use Checkout\Tamara\Metadata\Card\CardMetadataFormatType;
use Checkout\Tamara\Metadata\Card\CardMetadataRequest;
use Checkout\Tamara\Metadata\Card\Source\CardMetadataBinSource;
use Checkout\Tamara\Metadata\Card\Source\CardMetadataCardSource;
use Checkout\Tamara\Metadata\Card\Source\CardMetadataTokenSource;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;
use Checkout\Tests\TestCardSource;
use Checkout\Tamara\Tokens\CardTokenRequest;

class MetadataIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$default_oauth);
    }

    /**
     * @test
     */
    public function shouldRequestMetadataCardForBinNumber()
    {
        $metadataRequest = new CardMetadataRequest();
        $metadataRequest->format = CardMetadataFormatType::$BASIC;
        $metadataRequest->source = new CardMetadataBinSource();
        $metadataRequest->source->bin = substr(TestCardSource::$VisaNumber, 0, 6);
        $this->makeCardMetadataRequest($metadataRequest);
    }

    /**
     * @test
     */
    public function shouldRequestCardMetadataForToken()
    {
        $metadataRequest = new CardMetadataRequest();
        $metadataRequest->format = CardMetadataFormatType::$BASIC;
        $metadataRequest->source = new CardMetadataTokenSource();
        $metadataRequest->source->token = $this->createValidTokenRequest();
        $this->makeCardMetadataRequest($metadataRequest);
    }

    /**
     * @test
     */
    public function shouldRequestCardMetadataForCardNumber()
    {
        $metadataRequest = new CardMetadataRequest();
        $metadataRequest->format = CardMetadataFormatType::$BASIC;
        $metadataRequest->source = new CardMetadataCardSource();
        $metadataRequest->source->number = TestCardSource::$VisaNumber;
        $this->makeCardMetadataRequest($metadataRequest);
    }

    private function makeCardMetadataRequest(CardMetadataRequest $cardMetadataRequest)
    {
        $response = $this->checkoutApi->getMetadataClient()->requestCardMetadata($cardMetadataRequest);
        $this->assertResponse(
            $response,
            "bin",
            "scheme",
            "card_type",
            "card_category",
            "issuer_country_name",
            "product_id",
            "product_type"
        );
    }

    /**
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws CheckoutException
     */
    private function createValidTokenRequest()
    {
        $api = CheckoutSdk::builder()->staticKeys()
            ->publicKey(getenv("CHECKOUT_DEFAULT_PUBLIC_KEY"))
            ->secretKey(getenv("CHECKOUT_DEFAULT_SECRET_KEY"))
            ->build();

        $cardTokenRequest = new CardTokenRequest();
        $cardTokenRequest->name = TestCardSource::$VisaName;
        $cardTokenRequest->number = TestCardSource::$VisaNumber;
        $cardTokenRequest->expiry_year = TestCardSource::$VisaExpiryYear;
        $cardTokenRequest->expiry_month = TestCardSource::$VisaExpiryMonth;
        $cardTokenRequest->cvv = TestCardSource::$VisaCvv;
        $cardTokenRequest->billing_address = $this->getAddress();
        $cardTokenRequest->phone = $this->getPhone();

        $token = $api->getTokensClient()->requestCardToken($cardTokenRequest);
        return $token["token"];
    }
}
