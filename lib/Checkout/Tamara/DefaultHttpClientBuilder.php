<?php

namespace Checkout\Tamara;

use Checkout\Tamara\HttpClientBuilderInterface;
use GuzzleHttp\Client as GuzzleHttpClient;

final class DefaultHttpClientBuilder implements HttpClientBuilderInterface
{

    private $client;

    public function __construct()
    {
        $this->client = new GuzzleHttpClient();
    }

    /**
     * @return GuzzleHttpClient
     */
    public function getClient()
    {
        return $this->client;
    }
}
