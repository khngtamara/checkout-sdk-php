<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\ScheduleFrequency;
use Checkout\Tamara\Accounts\ScheduleRequest;

class ScheduleFrequencyWeeklyRequest extends ScheduleRequest
{
    /**
     * @var array values of DaySchedule
     */
    public $by_day;

    public function __construct()
    {
        parent::__construct(ScheduleFrequency::$WEEKLY);
    }
}
