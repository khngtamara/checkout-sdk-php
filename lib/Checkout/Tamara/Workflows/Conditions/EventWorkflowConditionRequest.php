<?php

namespace Checkout\Tamara\Workflows\Conditions;

use Checkout\Tamara\Workflows\Conditions\WorkflowConditionRequest;
use Checkout\Tamara\Workflows\Conditions\WorkflowConditionType;

class EventWorkflowConditionRequest extends WorkflowConditionRequest
{
    /**
     * @var array
     */
    public $events;

    public function __construct()
    {
        parent::__construct(WorkflowConditionType::$event);
    }
}
