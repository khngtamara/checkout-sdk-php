<?php

namespace Checkout\Tamara\Workflows\Conditions;

use Checkout\Tamara\Workflows\Conditions\WorkflowConditionRequest;
use Checkout\Tamara\Workflows\Conditions\WorkflowConditionType;

class EntityWorkflowConditionRequest extends WorkflowConditionRequest
{
    /**
     * @var array
     */
    public $entities;

    public function __construct()
    {
        parent::__construct(WorkflowConditionType::$entity);
    }
}
