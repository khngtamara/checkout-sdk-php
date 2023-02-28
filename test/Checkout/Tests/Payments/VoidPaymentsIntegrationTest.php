<?php

namespace Checkout\Tests\Payments;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Payments\VoidRequest;

class VoidPaymentsIntegrationTest extends AbstractPaymentsIntegrationTest
{

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldVoidCardPayment()
    {
        $paymentResponse = $this->makeCardPayment();

        $voidRequest = new \Checkout\Tamara\Payments\VoidRequest();
        $voidRequest->reference = uniqid("shouldVoidCardPayment");

        $response = $this->retriable(
            function () use (&$paymentResponse, &$voidRequest) {
                return $this->checkoutApi->getPaymentsClient()->voidPayment($paymentResponse["id"], $voidRequest);
            }
        );

        $this->assertResponse(
            $response,
            "action_id",
            "reference"
        );
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldVoidCardPaymentIdempotent()
    {
        $paymentResponse = $this->makeCardPayment();

        $voidRequest = new VoidRequest();
        $voidRequest->reference = uniqid("shouldVoidCardPayment");

        $idempotencyKey = $this->idempotencyKey();

        $response1 = $this->retriable(
            function () use (&$paymentResponse, &$voidRequest, &$idempotencyKey) {
                return $this->checkoutApi->getPaymentsClient()->voidPayment($paymentResponse["id"], $voidRequest, $idempotencyKey);
            }
        );

        $this->assertNotNull($response1);

        $response2 = $this->retriable(
            function () use (&$paymentResponse, &$voidRequest, &$idempotencyKey) {
                return $this->checkoutApi->getPaymentsClient()->voidPayment($paymentResponse["id"], $voidRequest, $idempotencyKey);
            }
        );

        $this->assertNotNull($response2);
        $this->assertEquals($response1["action_id"], $response2["action_id"]);
    }
}
