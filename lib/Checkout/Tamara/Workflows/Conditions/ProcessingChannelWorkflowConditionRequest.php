<?php

namespace Checkout\Tamara\Workflows\Conditions;

use Checkout\Tamara\Workflows\Conditions\WorkflowConditionRequest;
use Checkout\Tamara\Workflows\Conditions\WorkflowConditionType;

class ProcessingChannelWorkflowConditionRequest extends WorkflowConditionRequest
{
    /**
     * @var array
     */
    public $processing_channels;

    public function __construct()
    {
        parent::__construct(WorkflowConditionType::$processing_channel);
    }
}
