<?php

namespace Checkout\Tests\Sessions;

use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\Sessions\SessionSecretSdkCredentials;
use Checkout\Tests\UnitTestFixture;

class SessionSecretSdkCredentialsTest extends UnitTestFixture
{

    /**
     * @test
     */
    public function shouldCreateSessionSecretSdkCredentials()
    {
        $credentials = new \Checkout\Tamara\Sessions\SessionSecretSdkCredentials("test");
        $this->assertEquals("test", $credentials->secret);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    public function shouldGetAuthorization()
    {
        $credentials = new \Checkout\Tamara\Sessions\SessionSecretSdkCredentials("test");
        $auth = $credentials->getAuthorization("custom");
        $this->assertNotNull($auth);
        $this->assertEquals("test", $auth->getAuthorizationHeader());
    }
}
