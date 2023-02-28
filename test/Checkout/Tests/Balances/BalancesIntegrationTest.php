<?php

namespace Checkout\Tests\Balances;

use Checkout\Tamara\Balances\BalancesQuery;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class BalancesIntegrationTest extends SandboxTestFixture
{
    /**
     * @before
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
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
    public function shouldRetrieveEntityBalances()
    {
        $balancesQuery = new BalancesQuery();
        $balancesQuery->query = "currency:" . Currency::$GBP;

        $balances = $this->checkoutApi->getBalancesClient()->retrieveEntityBalances("ent_kidtcgc3ge5unf4a5i6enhnr5m", $balancesQuery);
        $this->assertResponse($balances, "data", "_links");
        foreach ($balances["data"] as $balanceData) {
            $this->assertResponse(
                $balanceData,
                "descriptor",
                "holding_currency",
                "balances",
                "balances.available"
            );
        }
    }
}
