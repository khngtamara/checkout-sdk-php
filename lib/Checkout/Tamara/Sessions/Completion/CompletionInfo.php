<?php

namespace Checkout\Tamara\Sessions\Completion;

abstract class CompletionInfo
{
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @var string value of CompletionInfoType
     */
    public $type;
}
