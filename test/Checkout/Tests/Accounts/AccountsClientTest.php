<?php

namespace Checkout\Tests\Accounts;

use Checkout\Tamara\Accounts\AccountsClient;
use Checkout\Tamara\Accounts\AccountsFileRequest;
use Checkout\Tamara\Accounts\AccountsPaymentInstrument;
use Checkout\Tamara\Accounts\OnboardEntityRequest;
use Checkout\Tamara\Accounts\PaymentInstrumentRequest;
use Checkout\Tamara\Accounts\PaymentInstrumentsQuery;
use Checkout\Tamara\Accounts\UpdatePaymentInstrumentRequest;
use Checkout\Tamara\Accounts\UpdateScheduleRequest;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class AccountsClientTest extends UnitTestFixture
{
    /**
     * @var AccountsClient
     */
    private $client;

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws CheckoutException
     */
    public function init()
    {
        $this->initMocks(PlatformType::$default_oauth);
        $this->client = new \Checkout\Tamara\Accounts\AccountsClient(
            $this->apiClient,
            $this->apiClient,
            $this->configuration
        );
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateEntity()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->CreateEntity(new \Checkout\Tamara\Accounts\OnboardEntityRequest());

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetEntity()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->GetEntity("entity_id");

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldUpdateEntity()
    {
        $this->apiClient
            ->method("put")
            ->willReturn("response");

        $response = $this->client->UpdateEntity("entity_id", new OnboardEntityRequest());

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreatePaymentInstrument()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->CreatePaymentInstrument("entity_id", new AccountsPaymentInstrument());

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldSubmitFile()
    {
        $this->apiClient
            ->method("submitFileFilesApi")
            ->willReturn("response");

        $fileRequest = new AccountsFileRequest();
        $fileRequest->file = "filepath";
        $fileRequest->purpose = "individual";
        $fileRequest->content_type = "image/jpeg";

        $response = $this->client->submitFile($fileRequest);

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldUpdatePayoutSchedule()
    {
        $this->apiClient
            ->method("put")
            ->willReturn("response");

        $response = $this->client->updatePayoutSchedule("entity_id", Currency::$USD, new \Checkout\Tamara\Accounts\UpdateScheduleRequest());

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRetrievePayoutSchedule()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->retrievePayoutSchedule("entity_id");

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRetrievePaymentInstrumentDetails()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("response");

        $response = $this->client->retrievePaymentInstrumentDetails("entity_id", "instrument_id");

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldQueryPaymentInstruments()
    {
        $this->apiClient
            ->method("query")
            ->willReturn("response");

        $response = $this->client->queryPaymentInstruments("entity_id", new \Checkout\Tamara\Accounts\PaymentInstrumentsQuery());

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateBankPaymentInstrument()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("response");

        $response = $this->client->createBankPaymentInstrument("entity_id", new \Checkout\Tamara\Accounts\PaymentInstrumentRequest());

        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldUpdateBankPaymentInstrument()
    {
        $this->apiClient
            ->method("patch")
            ->willReturn("response");

        $response = $this->client->updateBankPaymentInstrumentDetails("entity_id", "instrument_id", new \Checkout\Tamara\Accounts\UpdatePaymentInstrumentRequest());

        $this->assertNotNull($response);
    }
}
