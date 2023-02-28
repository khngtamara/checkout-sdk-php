<?php

namespace Checkout\Tamara\Sessions\Source;

use Checkout\Tamara\Sessions\SessionSourceType;
use Checkout\Tamara\Sessions\Source\SessionSource;

class RequestTokenSource extends SessionSource
{
    public function __construct()
    {
        parent::__construct(SessionSourceType::$token);
    }

    /**
     * @var string
     */
    public $token;

    /**
     * @var bool
     */
    public $store_for_future_use;
}
