<?php

namespace Checkout\Tamara\Sessions\Completion;

use Checkout\Tamara\Sessions\Completion\CompletionInfo;
use Checkout\Tamara\Sessions\Completion\CompletionInfoType;

class HostedCompletionInfo extends CompletionInfo
{
    public function __construct()
    {
        parent::__construct(CompletionInfoType::$hosted);
    }

    /**
     * @var string
     */
    public $callback_url;

    /**
     * @var string
     */
    public $success_url;

    /**
     * @var string
     */
    public $failure_url;
}
