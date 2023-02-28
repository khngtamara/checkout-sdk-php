<?php

namespace Checkout\Tamara\Sessions;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Sessions\Channel\ChannelData;
use Checkout\Tamara\Sessions\SessionRequest;
use Checkout\Tamara\Sessions\SessionSecretSdkCredentials;
use Checkout\Tamara\Sessions\ThreeDsMethodCompletionRequest;

class SessionsClient extends Client
{
    const SESSIONS_PATH = "sessions";
    const COLLECT_DATA_PATH = "collect-data";
    const COMPLETE_PATH = "complete";
    const ISSUER_FINGERPRINT_PATH = "issuer-fingerprint";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$oAuth);
    }

    /**
     * @param SessionRequest $sessionRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function requestSession(SessionRequest $sessionRequest)
    {
        return $this->apiClient->post(self::SESSIONS_PATH, $sessionRequest, $this->sdkAuthorization());
    }

    /**
     * @param $sessionId
     * @param string|null $sessionSecret
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    public function getSessionDetails($sessionId, $sessionSecret = null)
    {
        return $this->apiClient->get($this->buildPath(self::SESSIONS_PATH, $sessionId), $this->getSdkAuthorization($sessionSecret));
    }

    /**
     * @param $sessionId
     * @param ChannelData $channelData
     * @param string|null $sessionSecret
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    public function updateSession($sessionId, ChannelData $channelData, $sessionSecret = null)
    {
        return $this->apiClient->put($this->buildPath(self::SESSIONS_PATH, $sessionId, self::COLLECT_DATA_PATH), $channelData, $this->getSdkAuthorization($sessionSecret));
    }

    /**
     * @param $sessionId
     * @param string|null $sessionSecret
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    public function completeSession($sessionId, $sessionSecret = null)
    {
        return $this->apiClient->post($this->buildPath(self::SESSIONS_PATH, $sessionId, self::COMPLETE_PATH), null, $this->getSdkAuthorization($sessionSecret));
    }

    /**
     * @param $sessionId
     * @param ThreeDsMethodCompletionRequest $threeDsMethodCompletionRequest
     * @param string|null $sessionSecret
     * @return array
     * @throws CheckoutApiException
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    public function updateThreeDsMethodCompletionIndicator($sessionId, ThreeDsMethodCompletionRequest $threeDsMethodCompletionRequest, $sessionSecret = null)
    {
        return $this->apiClient->put($this->buildPath(self::SESSIONS_PATH, $sessionId, self::ISSUER_FINGERPRINT_PATH), $threeDsMethodCompletionRequest, $this->getSdkAuthorization($sessionSecret));
    }

    /**
     * @throws \Checkout\Tamara\CheckoutAuthorizationException
     */
    private function getSdkAuthorization($sessionSecret = null)
    {
        if (is_null($sessionSecret)) {
            return $this->sdkAuthorization();
        } else {
            $sdkAuthorization = new SessionSecretSdkCredentials($sessionSecret);
            return $sdkAuthorization->getAuthorization(AuthorizationType::$custom);
        }
    }

}
