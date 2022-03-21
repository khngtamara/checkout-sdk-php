<?php

namespace Checkout\Tests\Payments;

use Checkout\CheckoutApiException;
use Closure;

class PaymentActionsIntegrationTest extends AbstractPaymentsIntegrationTest
{

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetPaymentActions()
    {
        $paymentResponse = $this->makeCardPayment(true);

        $actions = $this->retriable(
            function () use (&$paymentResponse) {
                return $this->defaultApi->getPaymentsClient()->getPaymentActions($paymentResponse["id"]);
            },
            $this->thereAreTwoPaymentActions());

        $this->assertNotNull($actions);
        $this->assertCount(2, $actions);
        foreach ($actions as $paymentAction) {
            $this->assertResponse($paymentAction,
                "amount",
                "approved",
                "processed_on",
                "reference",
                "response_code",
                "response_summary",
                "type");
        }
    }

    /**
     * @return Closure
     */
    private function thereAreTwoPaymentActions()
    {
        return function ($response) {
            return sizeof($response) == 2;
        };
    }
}
