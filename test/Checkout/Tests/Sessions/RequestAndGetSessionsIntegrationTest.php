<?php

namespace Checkout\Tests\Sessions;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\Common\ChallengeIndicatorType;
use Checkout\Tamara\Sessions\Category;
use Checkout\Tamara\Sessions\TransactionType;

class RequestAndGetSessionsIntegrationTest extends AbstractSessionsIntegrationTest
{

    /**
     * @test
     * @throws CheckoutApiException
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    public function shouldRequestAndGetCardSessionBrowserSession()
    {
        $browserSession = $this->getBrowserSession();
        $responseBrowserSession = $this->createNonHostedSession(
            $browserSession,
            Category::$payment,
            ChallengeIndicatorType::$no_preference,
            TransactionType::$goods_service
        );

        $this->assertNotNull($responseBrowserSession);

        $sessionId = $responseBrowserSession["id"];
        $sessionSecret = $responseBrowserSession["session_secret"];

        $responseSessionDetails = $this->checkoutApi->getSessionsClient()->getSessionDetails($sessionId);
        $this->assertNotNull($responseSessionDetails);
        $responseSessionDetailsWithSecret = $this->checkoutApi->getSessionsClient()->getSessionDetails(
            $sessionId,
            $sessionSecret
        );
        $this->assertNotNull($responseSessionDetailsWithSecret);
    }

    /**
     * @test
     * @throws CheckoutApiException
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    public function shouldRequestAndGetCardSessionAppSession()
    {
        $this->markTestSkipped("unstable");
        $appSession = $this->getAppSession();
        $responseNonHostedSession = $this->createNonHostedSession(
            $appSession,
            \Checkout\Tamara\Sessions\Category::$payment,
            ChallengeIndicatorType::$no_preference,
            TransactionType::$goods_service
        );

        $this->assertNotNull($responseNonHostedSession);

        $sessionId = $responseNonHostedSession["id"];
        $sessionSecret = $responseNonHostedSession["session_secret"];

        $responseSessionDetails = $this->checkoutApi->getSessionsClient()->getSessionDetails($sessionId);
        $this->assertNotNull($responseSessionDetails);
        $responseSessionDetailsWithSecret = $this->checkoutApi->getSessionsClient()->getSessionDetails(
            $sessionId,
            $sessionSecret
        );
        $this->assertNotNull($responseSessionDetailsWithSecret);
    }
}
