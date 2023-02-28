<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\ScheduleRequest;

class UpdateScheduleRequest
{
    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var int
     */
    public $threshold;

    /**
     * @var ScheduleRequest
     */
    public $recurrence;
}
