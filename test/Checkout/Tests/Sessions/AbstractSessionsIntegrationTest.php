<?php

namespace Checkout\Tests\Sessions;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\ChallengeIndicatorType;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\Phone;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\Sessions\AuthenticationType;
use Checkout\Tamara\Sessions\Category;
use Checkout\Tamara\Sessions\Channel\AppSession;
use Checkout\Tamara\Sessions\Channel\BrowserSession;
use Checkout\Tamara\Sessions\Channel\ChannelData;
use Checkout\Tamara\Sessions\Channel\SdkEphemeralPublicKey;
use Checkout\Tamara\Sessions\Channel\SdkInterfaceType;
use Checkout\Tamara\Sessions\Channel\ThreeDsMethodCompletion;
use Checkout\Tamara\Sessions\Completion\HostedCompletionInfo;
use Checkout\Tamara\Sessions\Completion\NonHostedCompletionInfo;
use Checkout\Tamara\Sessions\SessionAddress;
use Checkout\Tamara\Sessions\SessionMarketplaceData;
use Checkout\Tamara\Sessions\SessionRequest;
use Checkout\Tamara\Sessions\SessionsBillingDescriptor;
use Checkout\Tamara\Sessions\Source\SessionCardSource;
use Checkout\Tamara\Sessions\TransactionType;
use Checkout\Tamara\Sessions\UIElements;
use Checkout\Tests\SandboxTestFixture;
use Checkout\Tests\TestCardSource;

abstract class AbstractSessionsIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws \Checkout\Tamara\CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$default_oauth);
    }

    /**
     * @param ChannelData $channelData
     * @param string $authenticationCategory
     * @param string $challengeIndicatorType
     * @param string $transactionType
     * @return mixed
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    protected function createNonHostedSession(
        ChannelData $channelData,
        $authenticationCategory,
        $challengeIndicatorType,
        $transactionType
    ) {

        $billingAddress = new SessionAddress();
        $billingAddress->address_line1 = "CheckoutSdk.com";
        $billingAddress->address_line2 = "90 Tottenham Court Road";
        $billingAddress->city = "London";
        $billingAddress->state = "ENG";
        $billingAddress->country = Country::$GB;

        $sessionCardSource = new SessionCardSource();
        $sessionCardSource->billing_address = $billingAddress;
        $sessionCardSource->number = TestCardSource::$VisaNumber;
        $sessionCardSource->expiry_month = TestCardSource::$VisaExpiryMonth;
        $sessionCardSource->expiry_year = TestCardSource::$VisaExpiryYear;
        $sessionCardSource->name = "John Doe";
        $sessionCardSource->email = $this->randomEmail();
        $sessionCardSource->home_phone = $this->getPhone();
        $sessionCardSource->work_phone = $this->getPhone();
        $sessionCardSource->mobile_phone = $this->getPhone();

        $shippingAddress = new SessionAddress();
        $shippingAddress->address_line1 = "CheckoutSdk.com";
        $shippingAddress->address_line2 = "ABC building";
        $shippingAddress->address_line3 = "14 Wells Mews";
        $shippingAddress->city = "London";
        $shippingAddress->state = "ENG";
        $shippingAddress->zip = "W1T 4TJ";
        $shippingAddress->country = Country::$GB;

        $marketPlaceData = new SessionMarketplaceData();
        $marketPlaceData->sub_entity_id = "ent_ocw5i74vowfg2edpy66izhts2u";

        $billingDescriptor = new SessionsBillingDescriptor();
        $billingDescriptor->name = "SUPERHEROES.COM";

        $nonHostedCompletionInfo = new NonHostedCompletionInfo();
        $nonHostedCompletionInfo->callback_url = "https://merchant.com/callback";

        $sessionRequest = new SessionRequest();
        $sessionRequest->source = $sessionCardSource;
        $sessionRequest->amount = 6540;
        $sessionRequest->currency = Currency::$USD;
        $sessionRequest->processing_channel_id = "pc_5jp2az55l3cuths25t5p3xhwru";
        $sessionRequest->marketplace = $marketPlaceData;
        $sessionRequest->authentication_category = $authenticationCategory;
        $sessionRequest->challenge_indicator = $challengeIndicatorType;
        $sessionRequest->billing_descriptor = $billingDescriptor;
        $sessionRequest->reference = "ORD-5023-4E89";
        $sessionRequest->transaction_type = $transactionType;
        $sessionRequest->shipping_address = $shippingAddress;
        $sessionRequest->completion = $nonHostedCompletionInfo;
        $sessionRequest->channel_data = $channelData;

        $responseNonHostedSession = $this->checkoutApi->getSessionsClient()->requestSession($sessionRequest);

        $this->assertResponse($responseNonHostedSession, "id", "session_secret");

        return $responseNonHostedSession;
    }

    protected function getPhone()
    {
        $phone = new Phone();
        $phone->number = "0204567895";
        $phone->country_code = "234";

        return $phone;
    }

    /**
     * @return mixed
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    protected function createHostedSession()
    {
        $shippingAddress = new SessionAddress();
        $shippingAddress->address_line1 = "CheckoutSdk.com";
        $shippingAddress->address_line2 = "90 Tottenham Court Road";
        $shippingAddress->city = "London";
        $shippingAddress->state = "ENG";
        $shippingAddress->zip = "W1T 4TJ";
        $shippingAddress->country = Country::$GB;

        $sessionCardSource = new SessionCardSource();
        $sessionCardSource->number = "4485040371536584";
        $sessionCardSource->expiry_month = 1;
        $sessionCardSource->expiry_year = 2030;

        $hostedCompletionInfo = new HostedCompletionInfo();
        $hostedCompletionInfo->failure_url = "https://example.com/sessions/fail";
        $hostedCompletionInfo->success_url = "https://example.com/sessions/success";

        $sessionRequest = new SessionRequest();
        $sessionRequest->source = $sessionCardSource;
        $sessionRequest->amount = 100;
        $sessionRequest->currency = Currency::$USD;
        $sessionRequest->processing_channel_id = "pc_5jp2az55l3cuths25t5p3xhwru";
        $sessionRequest->authentication_type = \Checkout\Tamara\Sessions\AuthenticationType::$regular;
        $sessionRequest->authentication_category = \Checkout\Tamara\Sessions\Category::$payment;
        $sessionRequest->challenge_indicator = ChallengeIndicatorType::$no_preference;
        $sessionRequest->reference = "ORD-5023-4E89";
        $sessionRequest->transaction_type = \Checkout\Tamara\Sessions\TransactionType::$goods_service;
        $sessionRequest->shipping_address = $shippingAddress;
        $sessionRequest->completion = $hostedCompletionInfo;

        $responseHostedSession = $this->checkoutApi->getSessionsClient()->requestSession($sessionRequest);

        $this->assertResponse($responseHostedSession, "id", "session_secret");
        return $responseHostedSession;
    }

    protected function getBrowserSession()
    {
        $browserSession = new BrowserSession();
        $browserSession->accept_header = "Accept:  *.*, q=0.1";
        $browserSession->java_enabled = true;
        $browserSession->language = "FR-fr";
        $browserSession->color_depth = "16";
        $browserSession->screen_width = "1920";
        $browserSession->screen_height = "1080";
        $browserSession->timezone = "60";
        $browserSession->user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36";
        $browserSession->three_ds_method_completion = ThreeDsMethodCompletion::$y;
        $browserSession->ip_address = "1.12.123.255";

        return $browserSession;
    }

    protected function getAppSession()
    {
        $sdkEphemeralPublicKey = new SdkEphemeralPublicKey();
        $sdkEphemeralPublicKey->kty = "EC";
        $sdkEphemeralPublicKey->crv = "P-256";
        $sdkEphemeralPublicKey->x = "f83OJ3D2xF1Bg8vub9tLe1gHMzV76e8Tus9uPHvRVEU";
        $sdkEphemeralPublicKey->y = "x_FEzRu9m36HLN_tue659LNpXW6pCyStikYjKIWI5a0";

        $appSession = new AppSession();
        $appSession->sdk_app_id = "dbd64fcb-c19a-4728-8849-e3d50bfdde39";
        $appSession->sdk_max_timeout = 5;
        $appSession->sdk_encrypted_data = "{}";
        $appSession->sdk_ephem_pub_key = $sdkEphemeralPublicKey;
        $appSession->sdk_reference_number = "3DS_LOA_SDK_PPFU_020100_00007";
        $appSession->sdk_transaction_id = "b2385523-a66c-4907-ac3c-91848e8c0067";
        $appSession->sdk_interface_type = SdkInterfaceType::$both;
        $appSession->sdk_ui_elements = array(UIElements::$single_select, \Checkout\Tamara\Sessions\UIElements::$html_other);

        return $appSession;
    }
}
