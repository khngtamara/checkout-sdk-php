<?php

namespace Checkout\Tests\Events\Previous;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Events\Previous\EventsClient;
use Checkout\Tamara\Events\Previous\RetrieveEventsRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class EventsClientTest extends UnitTestFixture
{
    /**
     * @var EventsClient
     */
    private $client;

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws CheckoutException
     */
    public function init()
    {
        $this->initMocks(PlatformType::$previous);
        $this->client = new EventsClient($this->apiClient, $this->configuration);
    }


    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRetrieveAllEventTypes()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->retrieveAllEventTypes();
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRetrieveEvents()
    {
        $this->apiClient->method("query")
            ->willReturn("foo");

        $response = $this->client->retrieveEvents(new \Checkout\Tamara\Events\Previous\RetrieveEventsRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRetrieveEvent()
    {
        $this->apiClient->method("get")
            ->willReturn("foo");


        $response = $this->client->retrieveEvent("event_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRetrieveEventNotification()
    {
        $this->apiClient->method("get")
            ->willReturn("foo");


        $response = $this->client->retrieveEventNotification("event_id", "notification_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldRetryWebhook()
    {
        $this->apiClient->method("post")
            ->willReturn("foo");


        $response = $this->client->retryWebhook("event_id", "webhook_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldRetryAllWebhooks()
    {
        $this->apiClient->method("post")
            ->willReturn("foo");


        $response = $this->client->retryAllWebhooks("event_id");
        $this->assertNotNull($response);
    }

}
