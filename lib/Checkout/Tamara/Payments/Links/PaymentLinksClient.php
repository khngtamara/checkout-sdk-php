<?php

namespace Checkout\Tamara\Payments\Links;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Payments\Links\PaymentLinkRequest;

class PaymentLinksClient extends Client
{

    const PAYMENT_LINKS = "payment-links";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKey);
    }

    /**
     * @param $id
     * @return array
     * @throws CheckoutApiException
     */
    public function getPaymentLink($id)
    {
        return $this->apiClient->get($this->buildPath(self::PAYMENT_LINKS, $id), $this->sdkAuthorization());
    }

    /**
     * @param PaymentLinkRequest $paymentLinkRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function createPaymentLink(PaymentLinkRequest $paymentLinkRequest)
    {
        return $this->apiClient->post(self::PAYMENT_LINKS, $paymentLinkRequest, $this->sdkAuthorization());
    }

}
