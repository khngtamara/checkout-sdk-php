<?php

namespace Checkout\Tamara\Sessions\Completion;

use Checkout\Tamara\Sessions\Completion\CompletionInfo;
use Checkout\Tamara\Sessions\Completion\CompletionInfoType;

class NonHostedCompletionInfo extends CompletionInfo
{
    public function __construct()
    {
        parent::__construct(CompletionInfoType::$nonHosted);
    }

    /**
     * @var string
     */
    public $callback_url;
}
