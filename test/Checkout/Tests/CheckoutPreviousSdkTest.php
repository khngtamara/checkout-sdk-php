<?php

namespace Checkout\Tests;

use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutSdk;
use Checkout\Tamara\Environment;
use Checkout\Tamara\HttpClientBuilderInterface;
use Exception;

class CheckoutPreviousSdkTest extends UnitTestFixture
{

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutArgumentException
     */
    public function shouldCreateCheckoutSdks()
    {

        $this->assertNotNull(CheckoutSdk::builder()
            ->previous()
            ->staticKeys()
            ->publicKey(parent::$validPreviousPk)
            ->secretKey(parent::$validPreviousSk)
            ->environment(Environment::sandbox())
            ->build());

        $this->assertNotNull(CheckoutSdk::builder()
            ->previous()
            ->staticKeys()
            ->secretKey(parent::$validPreviousSk)
            ->environment(Environment::sandbox())
            ->build());
    }

    /**
     * @test
     */
    public function shouldFailCreatingCheckoutSdks()
    {
        try {
            CheckoutSdk::builder()
                ->previous()
                ->staticKeys()
                ->publicKey(parent::$invalidPreviousPk)
                ->secretKey(parent::$validPreviousSk)
                ->environment(Environment::sandbox())
                ->build();
            $this->fail();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof CheckoutArgumentException);
            $this->assertEquals("invalid public key", $e->getMessage());
        }

        try {
            CheckoutSdk::builder()
                ->previous()
                ->staticKeys()
                ->publicKey(parent::$validPreviousPk)
                ->secretKey(parent::$invalidPreviousSk)
                ->environment(Environment::sandbox())
                ->build();
            $this->fail();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof CheckoutArgumentException);
            $this->assertEquals("invalid secret key", $e->getMessage());
        }
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutArgumentException
     */
    public function shouldInstantiateClientWithCustomHttpClient()
    {
        $httpBuilder = $this->createMock(HttpClientBuilderInterface::class);
        $httpBuilder->expects($this->once())->method("getClient");

        CheckoutSdk::builder()
            ->previous()
            ->staticKeys()
            ->publicKey(parent::$validPreviousPk)
            ->secretKey(parent::$validPreviousSk)
            ->environment(Environment::sandbox())
            ->httpClientBuilder($httpBuilder)
            ->build();
    }

}
