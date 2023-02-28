<?php

namespace Checkout\Tamara\Customers;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Client;
use Checkout\Tamara\Customers\CustomerRequest;

class CustomersClient extends Client
{
    const CUSTOMERS_PATH = "customers";

    /**
     * @param $customerId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function get($customerId)
    {
        return $this->apiClient->get($this->buildPath(self::CUSTOMERS_PATH, $customerId), $this->sdkAuthorization());
    }

    /**
     * @param CustomerRequest $customerRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function create(CustomerRequest $customerRequest)
    {
        return $this->apiClient->post(self::CUSTOMERS_PATH, $customerRequest, $this->sdkAuthorization());
    }

    /**
     * @param $customerId
     * @param CustomerRequest $customerRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function update($customerId, CustomerRequest $customerRequest)
    {
        return $this->apiClient->patch($this->buildPath(self::CUSTOMERS_PATH, $customerId), $customerRequest, $this->sdkAuthorization());
    }

    /**
     * @param $customerId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function delete($customerId)
    {
        return $this->apiClient->delete($this->buildPath(self::CUSTOMERS_PATH, $customerId), $this->sdkAuthorization());
    }
}
