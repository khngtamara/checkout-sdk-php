<?php

namespace Checkout\Tamara\Sessions\Source;

use Checkout\Tamara\Sessions\SessionSourceType;
use Checkout\Tamara\Sessions\Source\SessionSource;

class RequestNetworkTokenSource extends SessionSource
{
    public function __construct()
    {
        parent::__construct(SessionSourceType::$network_token);
    }

    /**
     * @var string
     */
    public $token;

    /**
     * @var int
     */
    public $expiry_month;

    /**
     * @var int
     */
    public $expiry_year;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $stored;
}
