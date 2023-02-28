<?php

namespace Checkout\Tamara\Disputes;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Files\FilesClient;
use Checkout\Tamara\Disputes\DisputeEvidenceRequest;
use Checkout\Tamara\Disputes\DisputesQueryFilter;

class DisputesClient extends FilesClient
{
    const DISPUTES_PATH = "disputes";
    const ACCEPT_PATH = "accept";
    const EVIDENCE_PATH = "evidence";
    const SCHEME_FILES_PATH = "schemefiles";

    /**
     * @param DisputesQueryFilter $filter
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function query(DisputesQueryFilter $filter)
    {
        return $this->apiClient->query(
            self::DISPUTES_PATH,
            $filter,
            $this->sdkAuthorization()
        );
    }

    /**
     * @param $disputeId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function getDisputeDetails($disputeId)
    {
        return $this->apiClient->get(
            $this->buildPath(self::DISPUTES_PATH, $disputeId),
            $this->sdkAuthorization()
        );
    }

    /**
     * @param $disputeId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function accept($disputeId)
    {
        return $this->apiClient->post(
            $this->buildPath(self::DISPUTES_PATH, $disputeId, self::ACCEPT_PATH),
            null,
            $this->sdkAuthorization()
        );
    }

    /**
     * @param $disputeId
     * @param DisputeEvidenceRequest $disputeEvidenceRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function putEvidence($disputeId, DisputeEvidenceRequest $disputeEvidenceRequest)
    {
        return $this->apiClient->put(
            $this->buildPath(self::DISPUTES_PATH, $disputeId, self::EVIDENCE_PATH),
            $disputeEvidenceRequest,
            $this->sdkAuthorization()
        );
    }

    /**
     * @param $disputeId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function getEvidence($disputeId)
    {
        return $this->apiClient->get(
            $this->buildPath(self::DISPUTES_PATH, $disputeId, self::EVIDENCE_PATH),
            $this->sdkAuthorization()
        );
    }

    /**
     * @param $disputeId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function submitEvidence($disputeId)
    {
        return $this->apiClient->post(
            $this->buildPath(self::DISPUTES_PATH, $disputeId, self::EVIDENCE_PATH),
            null,
            $this->sdkAuthorization()
        );
    }

    /**
     * @param string $disputeId
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function getDisputeSchemeFiles($disputeId)
    {
        return $this->apiClient->get(
            $this->buildPath(self::DISPUTES_PATH, $disputeId, self::SCHEME_FILES_PATH),
            $this->sdkAuthorization()
        );
    }

}
