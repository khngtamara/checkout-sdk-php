<?php

namespace Checkout\Tamara\Files;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\Client;
use Checkout\Tamara\Files\FileRequest;

class FilesClient extends Client
{
    const FILES_PATH = "files";

    const ALLOWED_CONTENTS = [
        "image/jpeg",
        "image/png",
        "application/pdf"
    ];

    /**
     * @param FileRequest $fileRequest
     * @return array
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function uploadFile(FileRequest $fileRequest)
    {
        $this->validateContents($fileRequest->file);
        return $this->apiClient->submitFile(self::FILES_PATH, $fileRequest, $this->sdkAuthorization());
    }

    /**
     * @param $fileId
     * @return array
     * @throws CheckoutApiException
     */
    public function getFileDetails($fileId)
    {
        return $this->apiClient->get($this->buildPath(self::FILES_PATH, $fileId), $this->sdkAuthorization());
    }

    /**
     * @param $file
     * @throws CheckoutApiException
     */
    private function validateContents($file)
    {
        if (!in_array(mime_content_type($file), self::ALLOWED_CONTENTS)) {
            throw new CheckoutApiException(
                "The file type is not supported.\n Supported file types: JPG/JPEG, PNG and PDF."
            );
        }
    }
}
