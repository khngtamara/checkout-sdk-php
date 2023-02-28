<?php

namespace Checkout\Tests\Webhooks\Previous;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;
use Checkout\Tamara\Webhooks\Previous\WebhookRequest;
use Checkout\Tamara\Webhooks\Previous\WebhooksClient;

class WebhooksClientTest extends UnitTestFixture
{
    /**
     * @var WebhooksClient
     */
    private $client;

    /**
     * @before
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new \Checkout\Tamara\Webhooks\Previous\WebhooksClient($this->apiClient, $this->configuration);
    }


    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRetrieveWebhooks()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->retrieveWebhooks();
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRetrieveWebhook()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->retrieveWebhook("webhook_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRegisterWebhook()
    {
        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->registerWebhook(new WebhookRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldUpdateWebhook()
    {
        $this->apiClient
            ->method("put")
            ->willReturn("foo");

        $response = $this->client->updateWebhook("webhook_id", new \Checkout\Tamara\Webhooks\Previous\WebhookRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldPatchWebhook()
    {
        $this->apiClient
            ->method("patch")
            ->willReturn("foo");

        $response = $this->client->patchWebhook("webhook_id", new WebhookRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRemoveWebhook()
    {
        $this->apiClient->method("delete")
            ->willReturn("foo");

        $response = $this->client->removeWebhook("webhook_id");
        $this->assertNotNull($response);
    }

}
