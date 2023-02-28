<?php

namespace Checkout\Tamara\Previous;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\Apm\CheckoutApmApi;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Customers\CustomersClient;
use Checkout\Tamara\Disputes\DisputesClient;
use Checkout\Tamara\Events\Previous\EventsClient;
use Checkout\Tamara\Instruments\Previous\InstrumentsClient;
use Checkout\Tamara\Payments\Hosted\HostedPaymentsClient;
use Checkout\Tamara\Payments\Links\PaymentLinksClient;
use Checkout\Tamara\Payments\Previous\PaymentsClient;
use Checkout\Tamara\Reconciliation\Previous\ReconciliationClient;
use Checkout\Tamara\Risk\RiskClient;
use Checkout\Tamara\Sources\Previous\SourcesClient;
use Checkout\Tamara\Tokens\TokensClient;
use Checkout\Tamara\Webhooks\Previous\WebhooksClient;

final class CheckoutApi extends CheckoutApmApi
{
    private $sourcesClient;
    private $tokensClient;
    private $instrumentsClient;
    private $webhooksClient;
    private $eventsClient;
    private $paymentsClient;
    private $customersClient;
    private $disputesClient;
    private $paymentLinksClient;
    private $hostedPaymentsClient;
    private $riskClient;
    private $reconciliationClient;

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration);
        $this->sourcesClient = new \Checkout\Tamara\Sources\Previous\SourcesClient($apiClient, $configuration);
        $this->tokensClient = new TokensClient($apiClient, $configuration);
        $this->instrumentsClient = new InstrumentsClient($apiClient, $configuration);
        $this->webhooksClient = new \Checkout\Tamara\Webhooks\Previous\WebhooksClient($apiClient, $configuration);
        $this->eventsClient = new \Checkout\Tamara\Events\Previous\EventsClient($apiClient, $configuration);
        $this->paymentsClient = new \Checkout\Tamara\Payments\Previous\PaymentsClient($apiClient, $configuration);
        $this->customersClient = new CustomersClient($apiClient, $configuration, AuthorizationType::$secretKey);
        $this->disputesClient = new DisputesClient($apiClient, $configuration, AuthorizationType::$secretKey);
        $this->paymentLinksClient = new PaymentLinksClient($apiClient, $configuration);
        $this->hostedPaymentsClient = new HostedPaymentsClient($apiClient, $configuration);
        $this->riskClient = new RiskClient($apiClient, $configuration);
        $this->reconciliationClient = new ReconciliationClient($apiClient, $configuration);
    }

    /**
     * @return \Checkout\Tamara\Sources\Previous\SourcesClient
     */
    public function getSourcesClient()
    {
        return $this->sourcesClient;
    }

    /**
     * @return TokensClient
     */
    public function getTokensClient()
    {
        return $this->tokensClient;
    }

    /**
     * @return \Checkout\Tamara\Instruments\Previous\InstrumentsClient
     */
    public function getInstrumentsClient()
    {
        return $this->instrumentsClient;
    }

    /**
     * @return WebhooksClient
     */
    public function getWebhooksClient()
    {
        return $this->webhooksClient;
    }

    /**
     * @return EventsClient
     */
    public function getEventsClient()
    {
        return $this->eventsClient;
    }

    /**
     * @return PaymentsClient
     */
    public function getPaymentsClient()
    {
        return $this->paymentsClient;
    }

    /**
     * @return CustomersClient
     */
    public function getCustomersClient()
    {
        return $this->customersClient;
    }

    /**
     * @return \Checkout\Tamara\Disputes\DisputesClient
     */
    public function getDisputesClient()
    {
        return $this->disputesClient;
    }

    /**
     * @return \Checkout\Tamara\Payments\Links\PaymentLinksClient
     */
    public function getPaymentLinksClient()
    {
        return $this->paymentLinksClient;
    }

    /**
     * @return \Checkout\Tamara\Payments\Hosted\HostedPaymentsClient
     */
    public function getHostedPaymentsClient()
    {
        return $this->hostedPaymentsClient;
    }

    /**
     * @return \Checkout\Tamara\Risk\RiskClient
     */
    public function getRiskClient()
    {
        return $this->riskClient;
    }

    /**
     * @return \Checkout\Tamara\Reconciliation\Previous\ReconciliationClient
     */
    public function getReconciliationClient()
    {
        return $this->reconciliationClient;
    }
}
