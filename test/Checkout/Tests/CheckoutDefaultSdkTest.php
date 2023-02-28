<?php

namespace Checkout\Tests;

use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutSdk;
use Checkout\Tamara\Environment;
use Checkout\Tamara\HttpClientBuilderInterface;
use Exception;

class CheckoutDefaultSdkTest extends UnitTestFixture
{

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutArgumentException
     */
    public function shouldCreateCheckoutSdks()
    {
        $this->assertNotNull(CheckoutSdk::builder()
            ->staticKeys()
            ->publicKey(parent::$validDefaultPk)
            ->secretKey(parent::$validDefaultSk)
            ->environment(Environment::sandbox())
            ->build());

        $this->assertNotNull(CheckoutSdk::builder()
            ->staticKeys()
            ->secretKey(parent::$validDefaultSk)
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
                ->staticKeys()
                ->publicKey(parent::$invalidDefaultPk)
                ->secretKey(parent::$validDefaultSk)
                ->environment(Environment::sandbox())
                ->build();
            $this->fail();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof CheckoutArgumentException);
            $this->assertEquals("invalid public key", $e->getMessage());
        }

        try {
            CheckoutSdk::builder()
                ->staticKeys()
                ->publicKey(parent::$validDefaultPk)
                ->secretKey(parent::$invalidDefaultSk)
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
        $httpBuilder->expects($this->exactly(4))->method("getClient");

        $this->assertNotNull(CheckoutSdk::builder()
            ->staticKeys()
            ->publicKey(parent::$validDefaultPk)
            ->secretKey(parent::$validDefaultSk)
            ->environment(Environment::sandbox())
            ->httpClientBuilder($httpBuilder)
            ->build());
    }

}
