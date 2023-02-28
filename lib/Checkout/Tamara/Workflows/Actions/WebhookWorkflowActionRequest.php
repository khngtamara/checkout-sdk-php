<?php

namespace Checkout\Tamara\Workflows\Actions;

use Checkout\Tamara\Workflows\Actions\WebhookSignature;
use Checkout\Tamara\Workflows\Actions\WorkflowActionRequest;
use Checkout\Tamara\Workflows\Actions\WorkflowActionType;

class WebhookWorkflowActionRequest extends WorkflowActionRequest
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var array
     */
    public $headers;

    /**
     * @var WebhookSignature
     */
    public $signature;

    public function __construct()
    {
        parent::__construct(WorkflowActionType::$webhook);
    }
}
