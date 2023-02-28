<?php

namespace Checkout\Tests\Apm\Ideal;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class IdealIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws \Checkout\Tamara\CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$default);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetInfo()
    {
        $this->markTestSkipped("unavailable");
        $response = $this->checkoutApi->getIdealClient()->getInfo();
        $this->assertResponse(
            $response,
            "_links",
            "_links.self",
            "_links.ideal:issuers",
            "_links.curies"
        );
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetIssuers()
    {
        $response = $this->checkoutApi->getIdealClient()->getIssuers();
        $this->assertResponse(
            $response,
            "countries",
            "_links",
            "_links.self"
        );
    }
}
