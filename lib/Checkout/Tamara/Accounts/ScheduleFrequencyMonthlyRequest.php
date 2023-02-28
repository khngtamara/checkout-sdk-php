<?php

namespace Checkout\Tamara\Accounts;

use Checkout\Tamara\Accounts\ScheduleFrequency;
use Checkout\Tamara\Accounts\ScheduleRequest;

class ScheduleFrequencyMonthlyRequest extends ScheduleRequest
{
    /**
     * @var array int
     */
    public $by_month_day;

    public function __construct()
    {
        parent::__construct(ScheduleFrequency::$MONTHLY);
    }
}
