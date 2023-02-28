<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\ScheduleFrequency;
use Checkout\Tamara\Accounts\ScheduleRequest;

class ScheduleFrequencyDailyRequest extends ScheduleRequest
{
    public function __construct()
    {
        parent::__construct(ScheduleFrequency::$DAILY);
    }
}
