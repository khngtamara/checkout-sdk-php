<?php

namespace Checkout\Tests\Disputes;

use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Disputes\DisputeEvidenceRequest;
use Checkout\Tamara\Disputes\DisputesClient;
use Checkout\Tamara\Disputes\DisputesQueryFilter;
use Checkout\Tamara\Files\FileRequest;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\UnitTestFixture;

class DisputesClientTest extends UnitTestFixture
{
    /**
     * @var \Checkout\Tamara\Disputes\DisputesClient
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
        $this->client = new \Checkout\Tamara\Disputes\DisputesClient($this->apiClient, $this->configuration, AuthorizationType::$secretKey);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldQueryDispute()
    {

        $this->apiClient
            ->method("query")
            ->willReturn("foo");

        $response = $this->client->query(new \Checkout\Tamara\Disputes\DisputesQueryFilter());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetDisputeDetails()
    {

        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getDisputeDetails("dispute_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldAcceptDispute()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->accept("dispute_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldPutEvidence()
    {

        $this->apiClient
            ->method("put")
            ->willReturn("foo");

        $response = $this->client->putEvidence("dispute_id", new \Checkout\Tamara\Disputes\DisputeEvidenceRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetEvidence()
    {

        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getEvidence("dispute_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldSubmitEvidence()
    {

        $this->apiClient
            ->method("post")
            ->willReturn("foo");

        $response = $this->client->submitEvidence("dispute_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldUploadFile()
    {
        $fileRequest = new FileRequest();
        $fileRequest->file = self::getCheckoutFilePath();

        $this->apiClient
            ->method("submitFile")
            ->willReturn("foo");

        $response = $this->client->uploadFile($fileRequest);
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldGetFileDetails()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getFileDetails("file_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetDisputeSchemeFiles()
    {
        $this->apiClient
            ->method("get")
            ->willReturn("foo");

        $response = $this->client->getDisputeSchemeFiles("dispute_id");
        $this->assertNotNull($response);
    }

}
