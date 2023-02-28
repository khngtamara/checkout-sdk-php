<?php

namespace Checkout\Tests\Accounts;

use Checkout\Tamara\Accounts\AccountsFileRequest;
use Checkout\Tamara\Accounts\Company;
use Checkout\Tamara\Accounts\ContactDetails;
use Checkout\Tamara\Accounts\DateOfBirth;
use Checkout\Tamara\Accounts\EntityEmailAddresses;
use Checkout\Tamara\Accounts\Identification;
use Checkout\Tamara\Accounts\Individual;
use Checkout\Tamara\Accounts\InstrumentDetailsFasterPayments;
use Checkout\Tamara\Accounts\InstrumentDocument;
use Checkout\Tamara\Accounts\OnboardEntityRequest;
use Checkout\Tamara\Accounts\PaymentInstrumentRequest;
use Checkout\Tamara\Accounts\PaymentInstrumentsQuery;
use Checkout\Tamara\Accounts\Profile;
use Checkout\Tamara\Accounts\Representative;
use Checkout\Tamara\CheckoutApi;
use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\CheckoutSdk;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\InstrumentType;
use Checkout\Tamara\OAuthScope;
use Checkout\Tamara\PlatformType;
use Checkout\Tests\SandboxTestFixture;

class AccountsIntegrationTest extends SandboxTestFixture
{
    /**
     * @before
     * @throws
     */
    public function before()
    {
        $this->init(PlatformType::$default_oauth);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldCreateGetAndUpdateOnboardEntity()
    {
        $onboardEntityRequest = new OnboardEntityRequest();
        $onboardEntityRequest->reference = uniqid();
        $emailAddresses = new \Checkout\Tamara\Accounts\EntityEmailAddresses();
        $emailAddresses->primary = $this->randomEmail();
        $onboardEntityRequest->contact_details = new ContactDetails();
        $onboardEntityRequest->contact_details->phone = $this->getPhone();
        $onboardEntityRequest->contact_details->email_addresses = $emailAddresses;
        $onboardEntityRequest->profile = new \Checkout\Tamara\Accounts\Profile();
        $onboardEntityRequest->profile->urls = array("https://www.superheroexample.com");
        $onboardEntityRequest->profile->mccs = array("0742");
        $onboardEntityRequest->individual = new Individual();
        $onboardEntityRequest->individual->first_name = "Bruce";
        $onboardEntityRequest->individual->last_name = "Wayne";
        $onboardEntityRequest->individual->trading_name = "Batman's Super Hero Masks";
        $onboardEntityRequest->individual->registered_address = $this->getAddress();
        $onboardEntityRequest->individual->national_tax_id = "TAX123456";
        $onboardEntityRequest->individual->date_of_birth = $this->getDateOfBirth();
        $onboardEntityRequest->individual->identification = $this->getTestIdentification();

        $response = $this->checkoutApi->getAccountsClient()->createEntity($onboardEntityRequest);

        $this->assertResponse($response, "id", "reference");

        $response = $this->checkoutApi->getAccountsClient()->getEntity($response["id"]);

        $this->assertResponse(
            $response,
            "id",
            "reference",
            "contact_details",
            "contact_details.phone",
            "contact_details.phone.number",
            "contact_details.email_addresses.primary",
            "individual",
            "individual.first_name",
            "individual.last_name",
            "individual.trading_name",
            "individual.national_tax_id"
        );

        $onboardEntityRequest->individual->first_name = "John";

        $updateResponse = $this->checkoutApi->getAccountsClient()->updateEntity($response["id"], $onboardEntityRequest);

        $this->assertResponse($updateResponse, "id");

        $this->assertEquals($response["id"], $updateResponse["id"]);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws \Checkout\Tamara\CheckoutException
     */
    public function shouldCreateAndRetrievePaymentInstrument()
    {
        $api = $this->getAccountsCheckoutApi();

        $representative = new \Checkout\Tamara\Accounts\Representative();
        $representative->first_name = "John";
        $representative->last_name = "Montana";
        $representative->address = $this->getAddress();
        $representative->identification = new \Checkout\Tamara\Accounts\Identification();
        $representative->identification->national_id_number = "AB123456C";

        $onboardEntityRequest = new OnboardEntityRequest();
        $onboardEntityRequest->reference = uniqid();
        $onboardEntityRequest->contact_details = new ContactDetails();
        $onboardEntityRequest->contact_details->phone = $this->getPhone();
        $onboardEntityRequest->contact_details->email_addresses = new \Checkout\Tamara\Accounts\EntityEmailAddresses();
        $onboardEntityRequest->contact_details->email_addresses->primary = $this->randomEmail();
        $onboardEntityRequest->profile = new Profile();
        $onboardEntityRequest->profile->urls = array("https://www.superheroexample.com");
        $onboardEntityRequest->profile->mccs = array("0742");
        $onboardEntityRequest->company = new Company();
        $onboardEntityRequest->company->business_registration_number = "01234567";
        $onboardEntityRequest->company->legal_name = "Super Hero Masks Inc.";
        $onboardEntityRequest->company->trading_name = "Super Hero Masks";
        $onboardEntityRequest->company->principal_address = $this->getAddress();
        $onboardEntityRequest->company->registered_address = $this->getAddress();
        $onboardEntityRequest->company->representatives = array($representative);

        $entity = $api->getAccountsClient()->createEntity($onboardEntityRequest);

        $file = $this->uploadFile();

        $instrumentRequest = new PaymentInstrumentRequest();
        $instrumentRequest->label = "Barclays";
        $instrumentRequest->type = InstrumentType::$bank_account;
        $instrumentRequest->currency = Currency::$GBP;
        $instrumentRequest->country = Country::$GB;
        $instrumentRequest->default = false;
        $instrumentRequest->document = new InstrumentDocument();
        $instrumentRequest->document->type = "bank_statement";
        $instrumentRequest->document->file_id = $file["id"];
        $instrumentRequest->instrument_details = new \Checkout\Tamara\Accounts\InstrumentDetailsFasterPayments();
        $instrumentRequest->instrument_details->account_number = "12334454";
        $instrumentRequest->instrument_details->bank_code = "050389";

        $instrumentResponse = $api->getAccountsClient()->createBankPaymentInstrument($entity["id"], $instrumentRequest);
        $this->assertResponse($instrumentResponse, "id");

        $instrumentDetails = $api->getAccountsClient()->retrievePaymentInstrumentDetails(
            $entity["id"],
            $instrumentResponse["id"]
        );
        $this->assertResponse(
            $instrumentDetails,
            "id",
            "status",
            "label",
            "type",
            "currency",
            "country",
            "document"
        );

        $queryResponse = $api->getAccountsClient()->queryPaymentInstruments($entity["id"], new \Checkout\Tamara\Accounts\PaymentInstrumentsQuery());
        $this->assertResponse($queryResponse, "data");
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldUploadAccountsFile()
    {
        $this->uploadFile();
    }

    private function getDateOfBirth()
    {
        $dateOfBirth = new DateOfBirth();
        $dateOfBirth->day = 5;
        $dateOfBirth->month = 6;
        $dateOfBirth->year = 1996;

        return $dateOfBirth;
    }

    private function getTestIdentification()
    {
        $identification = new Identification();
        $identification->national_id_number = "AB123456C";

        return $identification;
    }

    /**
     * @return CheckoutApi
     * @throws \Checkout\Tamara\CheckoutArgumentException
     * @throws \Checkout\Tamara\CheckoutException
     */
    private function getAccountsCheckoutApi()
    {
        return CheckoutSdk::builder()->oAuth()
            ->clientCredentials(
                getenv("CHECKOUT_DEFAULT_OAUTH_ACCOUNTS_CLIENT_ID"),
                getenv("CHECKOUT_DEFAULT_OAUTH_ACCOUNTS_CLIENT_SECRET")
            )
            ->scopes([OAuthScope::$Accounts])
            ->build();
    }

    /**
     * @return array
     * @throws CheckoutApiException
     */
    public function uploadFile()
    {
        $fileRequest = new \Checkout\Tamara\Accounts\AccountsFileRequest();
        $fileRequest->file = $this->getCheckoutFilePath();
        $fileRequest->content_type = "image/jpeg";
        $fileRequest->purpose = "bank_verification";

        $response = $this->checkoutApi->getAccountsClient()->submitFile($fileRequest);

        $this->assertResponse($response, "id");

        return $response;
    }
}
