<?php

namespace Checkout\Tamara\Payments\Hosted;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Payments\Hosted\HostedPaymentsSessionRequest;

class HostedPaymentsClient extends Client
{

    const HOSTED_PAYMENTS = "hosted-payments";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKey);
    }

    /**
     * @param $id
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function getHostedPaymentsPageDetails($id)
    {
        return $this->apiClient->get($this->buildPath(self::HOSTED_PAYMENTS, $id), $this->sdkAuthorization());
    }

    /**
     * @param HostedPaymentsSessionRequest $hostedPaymentRequest
     * @return array
     * @throws CheckoutApiException
     */
    public function createHostedPaymentsPageSession(HostedPaymentsSessionRequest $hostedPaymentRequest)
    {
        return $this->apiClient->post(self::HOSTED_PAYMENTS, $hostedPaymentRequest, $this->sdkAuthorization());
    }

}
