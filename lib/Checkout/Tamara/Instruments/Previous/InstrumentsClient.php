<?php

namespace Checkout\Tamara\Instruments\Previous;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Instruments\Previous\CreateInstrumentRequest;
use Checkout\Tamara\Instruments\Previous\UpdateInstrumentRequest;

class InstrumentsClient extends Client
{
    const INSTRUMENTS_PATH = "instruments";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKey);
    }

    /**
     * @param CreateInstrumentRequest $createInstrumentRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function create(CreateInstrumentRequest $createInstrumentRequest)
    {
        return $this->apiClient->post(self::INSTRUMENTS_PATH, $createInstrumentRequest, $this->sdkAuthorization());
    }

    /**
     * @param $instrumentId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function get($instrumentId)
    {
        return $this->apiClient->get($this->buildPath(self::INSTRUMENTS_PATH, $instrumentId), $this->sdkAuthorization());
    }

    /**
     * @param $instrumentId
     * @param UpdateInstrumentRequest $updateInstrumentRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function update($instrumentId, UpdateInstrumentRequest $updateInstrumentRequest)
    {
        return $this->apiClient->patch($this->buildPath(self::INSTRUMENTS_PATH, $instrumentId), $updateInstrumentRequest, $this->sdkAuthorization());
    }

    /**
     * @param $instrumentId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function delete($instrumentId)
    {
        return $this->apiClient->delete($this->buildPath(self::INSTRUMENTS_PATH, $instrumentId), $this->sdkAuthorization());
    }

}
