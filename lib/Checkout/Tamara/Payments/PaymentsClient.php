<?php

namespace Checkout\Tamara\Payments;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Payments\AuthorizationRequest;
use Checkout\Tamara\Payments\CaptureRequest;
use Checkout\Tamara\Payments\PaymentsQueryFilter;
use Checkout\Tamara\Payments\RefundRequest;
use Checkout\Tamara\Payments\Request\PaymentRequest;
use Checkout\Tamara\Payments\Request\PayoutRequest;
use Checkout\Tamara\Payments\VoidRequest;

class PaymentsClient extends Client
{
    const PAYMENTS_PATH = "payments";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKeyOrOAuth);
    }

    /**
     * @param PaymentRequest $paymentRequest
     * @param string|null $idempotencyKey
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function requestPayment(PaymentRequest $paymentRequest, $idempotencyKey = null)
    {
        return $this->apiClient->post(self::PAYMENTS_PATH, $paymentRequest, $this->sdkAuthorization(), $idempotencyKey);
    }

    /**
     * @param \Checkout\Tamara\Payments\Request\PayoutRequest $payoutRequest
     * @param string|null $idempotencyKey
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function requestPayout(PayoutRequest $payoutRequest, $idempotencyKey = null)
    {
        return $this->apiClient->post(self::PAYMENTS_PATH, $payoutRequest, $this->sdkAuthorization(), $idempotencyKey);
    }

    /**
     * @param PaymentsQueryFilter $queryFilter
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function getPaymentsList(PaymentsQueryFilter $queryFilter)
    {
        return $this->apiClient->query(self::PAYMENTS_PATH, $queryFilter, $this->sdkAuthorization());
    }

    /**
     * @param $paymentId
     * @return array
     * @throws CheckoutApiException
     */
    public function getPaymentDetails($paymentId)
    {
        return $this->apiClient->get($this->buildPath(self::PAYMENTS_PATH, $paymentId), $this->sdkAuthorization());
    }

    /**
     * @param $paymentId
     * @return array
     * @throws CheckoutApiException
     */
    public function getPaymentActions($paymentId)
    {
        return $this->apiClient->get($this->buildPath(self::PAYMENTS_PATH, $paymentId, "actions"), $this->sdkAuthorization());
    }

    /**
     * @param $paymentId
     * @param CaptureRequest $captureRequest
     * @param string|null $idempotencyKey
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function capturePayment($paymentId, CaptureRequest $captureRequest, $idempotencyKey = null)
    {
        return $this->apiClient->post($this->buildPath(self::PAYMENTS_PATH, $paymentId, "captures"), $captureRequest, $this->sdkAuthorization(), $idempotencyKey);
    }

    /**
     * @param $paymentId
     * @param RefundRequest|null $refundRequest
     * @param string|null $idempotencyKey
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function refundPayment($paymentId, RefundRequest $refundRequest = null, $idempotencyKey = null)
    {
        return $this->apiClient->post($this->buildPath(self::PAYMENTS_PATH, $paymentId, "refunds"), $refundRequest, $this->sdkAuthorization(), $idempotencyKey);
    }

    /**
     * @param $paymentId
     * @param VoidRequest|null $voidRequest
     * @param string|null $idempotencyKey
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function voidPayment($paymentId, VoidRequest $voidRequest = null, $idempotencyKey = null)
    {
        return $this->apiClient->post($this->buildPath(self::PAYMENTS_PATH, $paymentId, "voids"), $voidRequest, $this->sdkAuthorization(), $idempotencyKey);
    }

    /**
     * @param $paymentId
     * @param AuthorizationRequest|null $authorizationRequest
     * @param string|null $idempotencyKey
     * @return array
     * @throws CheckoutApiException
     */
    public function incrementPaymentAuthorization($paymentId, AuthorizationRequest $authorizationRequest = null, $idempotencyKey = null)
    {
        return $this->apiClient->post($this->buildPath(self::PAYMENTS_PATH, $paymentId, "authorizations"), $authorizationRequest, $this->sdkAuthorization(), $idempotencyKey);
    }

}
