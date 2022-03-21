<?php

namespace Checkout\Instruments\Four;

use Checkout\ApiClient;
use Checkout\AuthorizationType;
use Checkout\CheckoutApiException;
use Checkout\CheckoutConfiguration;
use Checkout\Client;
use Checkout\Instruments\Four\Create\CreateInstrumentRequest;
use Checkout\Instruments\Four\Get\BankAccountFieldQuery;
use Checkout\Instruments\Four\Update\UpdateInstrumentRequest;

class InstrumentsClient extends Client
{
    const INSTRUMENTS_PATH = "instruments";
    const VALIDATION_PATH = "validation/bank-accounts";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKeyOrOAuth);
    }

    /**
     * @param CreateInstrumentRequest $createInstrumentRequest
     * @return mixed
     * @throws CheckoutApiException
     */
    public function create(CreateInstrumentRequest $createInstrumentRequest)
    {
        return $this->apiClient->post(self::INSTRUMENTS_PATH, $createInstrumentRequest, $this->sdkAuthorization());
    }

    /**
     * @param $instrumentId
     * @return mixed
     * @throws CheckoutApiException
     */
    public function get($instrumentId)
    {
        return $this->apiClient->get($this->buildPath(self::INSTRUMENTS_PATH, $instrumentId), $this->sdkAuthorization());
    }

    /**
     * @param $instrumentId
     * @param UpdateInstrumentRequest $updateInstrumentRequest
     * @return mixed
     * @throws CheckoutApiException
     */
    public function update($instrumentId, UpdateInstrumentRequest $updateInstrumentRequest)
    {
        return $this->apiClient->patch($this->buildPath(self::INSTRUMENTS_PATH, $instrumentId), $updateInstrumentRequest, $this->sdkAuthorization());
    }

    /**
     * @param $instrumentId
     * @throws CheckoutApiException
     */
    public function delete($instrumentId)
    {
        $this->apiClient->delete($this->buildPath(self::INSTRUMENTS_PATH, $instrumentId), $this->sdkAuthorization());
    }

    /**
     * @param $country_code
     * @param $currency
     * @param BankAccountFieldQuery $query
     * @return mixed
     * @throws CheckoutApiException
     */
    public function getBankAccountFieldFormatting($country_code, $currency, BankAccountFieldQuery $query)
    {
        return $this->apiClient->query($this->buildPath(self::VALIDATION_PATH, $country_code, $currency), $query->normalized(), $this->sdkSpecificAuthorization(AuthorizationType::$oAuth));
    }
}
