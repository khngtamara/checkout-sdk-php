<?php

namespace Checkout\Tamara\Sessions;

use Checkout\Tamara\Common\ChallengeIndicatorType;
use Checkout\Tamara\Sessions\Channel\ChannelData;
use Checkout\Tamara\Sessions\CardholderAccountInfo;
use Checkout\Tamara\Sessions\Completion\CompletionInfo;
use Checkout\Tamara\Sessions\MerchantRiskInfo;
use Checkout\Tamara\Sessions\SessionAddress;
use Checkout\Tamara\Sessions\SessionMarketplaceData;
use Checkout\Tamara\Sessions\SessionsBillingDescriptor;
use Checkout\Tamara\Sessions\Source\SessionSource;
use Checkout\Tamara\Sessions\Installment;
use Checkout\Tamara\Sessions\Recurring;

class SessionRequest
{
    /**
     * @var SessionSource
     */
    public $source;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string value of Currency
     */
    public $currency;

    /**
     * @var string
     */
    public $processing_channel_id;

    /**
     * @var SessionMarketplaceData
     */
    public $marketplace;

    /**
     * @var string value of AuthenticationType
     */
    public $authentication_type;

    /**
     * @var string value of Category
     */
    public $authentication_category;

    /**
     * @var CardholderAccountInfo
     */
    public $account_info;

    /**
     * @var ChallengeIndicatorType
     */
    public $challenge_indicator;

    /**
     * @var SessionsBillingDescriptor
     */
    public $billing_descriptor;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var MerchantRiskInfo
     */
    public $merchant_risk_info;

    /**
     * @var string
     */
    public $prior_transaction_reference;

    /**
     * @var string value of TransactionType
     */
    public $transaction_type;

    /**
     * @var SessionAddress
     */
    public $shipping_address;

    /**
     * @var bool
     */
    public $shipping_address_matches_billing;

    /**
     * @var \Checkout\Tamara\Sessions\Completion\CompletionInfo
     */
    public $completion;

    /**
     * @var \Checkout\Tamara\Sessions\Channel\ChannelData
     */
    public $channel_data;

    /**
     * @var Recurring
     */
    public $recurring;

    /**
     * @var Installment
     */
    public $installment;
}
