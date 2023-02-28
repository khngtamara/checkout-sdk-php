<?php

namespace Checkout\Tests\Transfers;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;
use Checkout\Tamara\Transfers\CreateTransferRequest;
use Checkout\Tamara\Transfers\TransferDestination;
use Checkout\Tamara\Transfers\TransferSource;
use Checkout\Tamara\Transfers\TransferType;

class TransfersIntegrationTest extends SandboxTestFixture
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
     * @throws CheckoutApiException
     */
    public function shouldInitiateAndRetrieveTransferOfFunds()
    {
        $transferSource = new \Checkout\Tamara\Transfers\TransferSource();
        $transferSource->id = "ent_kidtcgc3ge5unf4a5i6enhnr5m";
        $transferSource->amount = 100;

        $transferDestination = new TransferDestination();
        $transferDestination->id = "ent_w4jelhppmfiufdnatam37wrfc4";

        $transferRequest = new \Checkout\Tamara\Transfers\CreateTransferRequest();
        $transferRequest->transfer_type = TransferType::$commission;
        $transferRequest->source = $transferSource;
        $transferRequest->destination = $transferDestination;

        $response = $this->checkoutApi->getTransfersClient()->initiateTransferOfFunds($transferRequest);

        $this->assertResponse($response, "id", "status");

        $transferResponse = $this->checkoutApi->getTransfersClient()->retrieveATransfer($response["id"]);

        $this->assertResponse(
            $transferResponse,
            "id",
            "source",
            "destination",
            "status",
            "requested_on",
            "transfer_type"
        );
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldInitiateTransferOfFundsIdempotently()
    {
        $transferSource = new TransferSource();
        $transferSource->id = "ent_kidtcgc3ge5unf4a5i6enhnr5m";
        $transferSource->amount = 100;

        $transferDestination = new \Checkout\Tamara\Transfers\TransferDestination();
        $transferDestination->id = "ent_w4jelhppmfiufdnatam37wrfc4";

        $transferRequest = new \Checkout\Tamara\Transfers\CreateTransferRequest();
        $transferRequest->transfer_type = TransferType::$commission;
        $transferRequest->source = $transferSource;
        $transferRequest->destination = $transferDestination;

        $idempotencyKey = self::idempotencyKey();

        $response1 = $this->checkoutApi->getTransfersClient()->initiateTransferOfFunds(
            $transferRequest,
            $idempotencyKey
        );

        $this->assertResponse($response1, "id", "status");

        try {
            $this->checkoutApi->getTransfersClient()->initiateTransferOfFunds(
                $transferRequest,
                $idempotencyKey
            );
            $this->fail("shouldn't get here!");
        } catch (CheckoutApiException $e) {
            $this->assertEquals(self::MESSAGE_409, $e->getMessage());
            $this->assertNotEmpty($e->http_metadata->getHeaders()["Cko-Request-Id"]);
        }
    }
}
