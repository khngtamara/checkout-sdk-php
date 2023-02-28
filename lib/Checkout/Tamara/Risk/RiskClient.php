<?php

namespace Checkout\Tamara\Risk;

use Checkout\Tamara\ApiClient;
use Checkout\Tamara\AuthorizationType;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutConfiguration;
use Checkout\Tamara\Client;
use Checkout\Tamara\Risk\PreAuthentication\PreAuthenticationAssessmentRequest;
use Checkout\Tamara\Risk\PreCapture\PreCaptureAssessmentRequest;

/**
 * @deprecated Risk endpoints are no longer supported officially, This module will be removed in a future release.
 */
class RiskClient extends Client
{
    const PRE_AUTHENTICATION_PATH = "risk/assessments/pre-authentication";
    const PRE_CAPTURE_PATH = "risk/assessments/pre-capture";

    public function __construct(ApiClient $apiClient, CheckoutConfiguration $configuration)
    {
        parent::__construct($apiClient, $configuration, AuthorizationType::$secretKey);
    }

    /**
     * @param \Checkout\Tamara\Risk\PreAuthentication\PreAuthenticationAssessmentRequest $preAuthenticationAssessmentRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function requestPreAuthenticationRiskScan(
        PreAuthenticationAssessmentRequest $preAuthenticationAssessmentRequest
    ) {
        return $this->apiClient->post(
            self::PRE_AUTHENTICATION_PATH,
            $preAuthenticationAssessmentRequest,
            $this->sdkAuthorization()
        );
    }

    /**
     * @param \Checkout\Tamara\Risk\PreCapture\PreCaptureAssessmentRequest $preCaptureAssessmentRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function requestPreCaptureRiskScan(PreCaptureAssessmentRequest $preCaptureAssessmentRequest)
    {
        return $this->apiClient->post(self::PRE_CAPTURE_PATH, $preCaptureAssessmentRequest, $this->sdkAuthorization());
    }
}
