<?php

namespace Checkout\Tests\Accounts;

use Checkout\Tamara\Accounts\DaySchedule;
use Checkout\Tamara\Accounts\ScheduleFrequencyDailyRequest;
use Checkout\Tamara\Accounts\ScheduleFrequencyMonthlyRequest;
use Checkout\Tamara\Accounts\ScheduleFrequencyWeeklyRequest;
use Checkout\Tamara\Accounts\UpdateScheduleRequest;
use Checkout\Tamara\CheckoutApi;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\CheckoutSdk;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\OAuthScope;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class AccountsPayoutSchedulesIntegrationTest extends SandboxTestFixture
{
    /**
     * @before
     * @throws
     */
    public function before()
    {
        try {
            $this->init(PlatformType::$default_oauth);
        } catch (CheckoutAuthorizationException $e) {
        }
    }

    /**
     * @test
     * @throws CheckoutApiException
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws CheckoutException
     */
    public function shouldUpdateAndRetrieveWeeklyPayoutSchedules()
    {
        $this->markTestSkipped("unavailable");
        $weeklyRequest = new \Checkout\Tamara\Accounts\ScheduleFrequencyWeeklyRequest();
        $weeklyRequest->by_day = [\Checkout\Tamara\Accounts\DaySchedule::$FRIDAY, DaySchedule::$MONDAY];

        $scheduleRequest = new \Checkout\Tamara\Accounts\UpdateScheduleRequest();
        $scheduleRequest->enabled = true;
        $scheduleRequest->threshold = 1000;
        $scheduleRequest->recurrence = $weeklyRequest;

        self::getPayoutSchedulesCheckoutApi()->getAccountsClient()->updatePayoutSchedule(
            "ent_sdioy6bajpzxyl3utftdp7legq",
            Currency::$USD,
            $scheduleRequest
        );


        $payoutSchedule = self::getPayoutSchedulesCheckoutApi()->getAccountsClient()
            ->retrievePayoutSchedule("ent_sdioy6bajpzxyl3utftdp7legq");

        $this->assertResponse(
            $payoutSchedule,
            "USD",
            "USD.enabled",
            "USD.threshold",
            "USD.recurrence",
            "USD.recurrence.frequency",
            "USD.recurrence.by_day"
        );
        self::assertTrue(is_array($payoutSchedule["USD"]["recurrence"]["by_day"]));
    }

    /**
     * @test
     * @throws CheckoutApiException
     * @throws CheckoutArgumentException
     * @throws CheckoutException
     */
    public function shouldUpdateAndRetrieveDailyPayoutSchedules()
    {
        $this->markTestSkipped("unavailable");
        $dailyRequest = new ScheduleFrequencyDailyRequest();

        $scheduleRequest = new \Checkout\Tamara\Accounts\UpdateScheduleRequest();
        $scheduleRequest->enabled = true;
        $scheduleRequest->threshold = 1000;
        $scheduleRequest->recurrence = $dailyRequest;

        self::getPayoutSchedulesCheckoutApi()->getAccountsClient()->updatePayoutSchedule(
            "ent_sdioy6bajpzxyl3utftdp7legq",
            Currency::$USD,
            $scheduleRequest
        );


        $payoutSchedule = self::getPayoutSchedulesCheckoutApi()->getAccountsClient()
            ->retrievePayoutSchedule("ent_sdioy6bajpzxyl3utftdp7legq");

        $this->assertResponse(
            $payoutSchedule,
            "USD",
            "USD.enabled",
            "USD.threshold",
            "USD.recurrence",
            "USD.recurrence.frequency"
        );
    }

    /**
     * @test
     * @throws CheckoutApiException
     * @throws CheckoutArgumentException
     * @throws CheckoutException
     */
    public function shouldUpdateAndRetrieveMonthlyPayoutSchedules()
    {
        $this->markTestSkipped("unavailable");
        $monthlyRequest = new ScheduleFrequencyMonthlyRequest();
        $monthlyRequest->by_month_day = [10, 5];

        $scheduleRequest = new \Checkout\Tamara\Accounts\UpdateScheduleRequest();
        $scheduleRequest->enabled = true;
        $scheduleRequest->threshold = 1000;
        $scheduleRequest->recurrence = $monthlyRequest;

        self::getPayoutSchedulesCheckoutApi()->getAccountsClient()->updatePayoutSchedule(
            "ent_sdioy6bajpzxyl3utftdp7legq",
            Currency::$USD,
            $scheduleRequest
        );


        $payoutSchedule = self::getPayoutSchedulesCheckoutApi()->getAccountsClient()
            ->retrievePayoutSchedule("ent_sdioy6bajpzxyl3utftdp7legq");

        $this->assertResponse(
            $payoutSchedule,
            "USD",
            "USD.enabled",
            "USD.threshold",
            "USD.recurrence",
            "USD.recurrence.frequency",
            "USD.recurrence.by_month_day"
        );
        self::assertTrue(is_array($payoutSchedule["USD"]["recurrence"]["by_month_day"]));
    }

    /**
     * @return \Checkout\Tamara\CheckoutApi
     * @throws CheckoutArgumentException
     * @throws CheckoutException
     */
    private static function getPayoutSchedulesCheckoutApi()
    {
        return CheckoutSdk::builder()->oAuth()
            ->clientCredentials(
                getenv("CHECKOUT_DEFAULT_OAUTH_PAYOUT_SCHEDULE_CLIENT_ID"),
                getenv("CHECKOUT_DEFAULT_OAUTH_PAYOUT_SCHEDULE_CLIENT_SECRET")
            )
            ->scopes([OAuthScope::$Accounts])
            ->build();
    }
}
