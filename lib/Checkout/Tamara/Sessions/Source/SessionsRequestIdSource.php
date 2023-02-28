<?php

namespace Checkout\Tamara\Sessions\Source;

use Checkout\Tamara\Sessions\SessionSourceType;
use Checkout\Tamara\Sessions\Source\SessionSource;

class SessionsRequestIdSource extends SessionSource
{
    public function __construct()
    {
        parent::__construct(SessionSourceType::$id);
    }

    /**
     * @var string
     */
    public $id;
}
