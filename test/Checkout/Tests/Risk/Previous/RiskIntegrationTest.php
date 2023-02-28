<?php

namespace Checkout\Tests\Risk\Previous;

use Checkout\Tamara\CheckoutApiException;
use Checkout\Tamara\CheckoutArgumentException;
use Checkout\Tamara\CheckoutAuthorizationException;
use Checkout\Tamara\CheckoutException;
use Checkout\Tamara\Common\Address;
use Checkout\Tamara\Common\Country;
use Checkout\Tamara\Common\Currency;
use Checkout\Tamara\Common\CustomerRequest;
use Checkout\Tamara\Common\InstrumentType;
use Checkout\Tamara\Instruments\Previous\CreateInstrumentRequest;
use Checkout\Tamara\Instruments\Previous\InstrumentAccountHolder;
use Checkout\Tamara\PlatformType;
use Checkout\Tamara\Risk\Device;
use Checkout\Tamara\Risk\Location;
use Checkout\Tamara\Risk\PreAuthentication\PreAuthenticationAssessmentRequest;
use Checkout\Tamara\Risk\PreCapture\AuthenticationResult;
use Checkout\Tamara\Risk\PreCapture\AuthorizationResult;
use Checkout\Tamara\Risk\PreCapture\PreCaptureAssessmentRequest;
use Checkout\Tamara\Risk\RiskPayment;
use Checkout\Tamara\Risk\RiskShippingDetails;
use Checkout\Tamara\Risk\Source\CardSourcePrism;
use Checkout\Tamara\Risk\Source\CustomerSourcePrism;
use Checkout\Tamara\Risk\Source\IdSourcePrism;
use Checkout\Tamara\Risk\Source\RiskPaymentRequestSource;
use Checkout\Tamara\Risk\Source\RiskRequestTokenSource;
use Checkout\Tests\SandboxTestFixture;
use Checkout\Tests\TestCardSource;
use Checkout\Tamara\Tokens\CardTokenRequest;
use DateTime;

class RiskIntegrationTest extends SandboxTestFixture
{

    /**
     * @before
     * @throws CheckoutAuthorizationException
     * @throws CheckoutArgumentException
     * @throws CheckoutException
     */
    public function before()
    {
        $this->init(PlatformType::$previous);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldPreCaptureAndAuthenticateCard()
    {
        $address = new Address();
        $address->address_line1 = "123 Street";
        $address->address_line2 = "Hollywood Avenue";
        $address->city = "Los Angeles";
        $address->state = "CA";
        $address->zip = "91001";
        $address->country = Country::$US;

        $cardSourcePrism = new CardSourcePrism();
        $cardSourcePrism->billing_address = $address;
        $cardSourcePrism->expiry_month = TestCardSource::$VisaExpiryMonth;
        $cardSourcePrism->expiry_year = TestCardSource::$VisaExpiryYear;
        $cardSourcePrism->number = TestCardSource::$VisaNumber;

        $this->doAuthenticationAssessmentRequest($cardSourcePrism);
        $this->doPreCaptureAssessmentRequest($cardSourcePrism);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldPreCaptureAndAuthenticateCustomer()
    {
        $customerRequest = new \Checkout\Tamara\Customers\CustomerRequest();
        $customerRequest->email = $this->randomEmail();
        $customerRequest->name = "User";
        $customerRequest->phone = $this->getPhone();

        $customerResponse = $this->previousApi->getCustomersClient()->create($customerRequest);

        $customerSourcePrism = new CustomerSourcePrism();
        $customerSourcePrism->id = $customerResponse["id"];

        $this->doAuthenticationAssessmentRequest($customerSourcePrism);
        $this->doPreCaptureAssessmentRequest($customerSourcePrism);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldPreCaptureAndAuthenticateId()
    {
        $cardTokenRequest = new CardTokenRequest();
        $cardTokenRequest->name = TestCardSource::$VisaName;
        $cardTokenRequest->number = TestCardSource::$VisaNumber;
        $cardTokenRequest->expiry_year = TestCardSource::$VisaExpiryYear;
        $cardTokenRequest->expiry_month = TestCardSource::$VisaExpiryMonth;
        $cardTokenRequest->cvv = TestCardSource::$VisaCvv;
        $cardTokenRequest->billing_address = $this->getAddress();
        $cardTokenRequest->phone = $this->getPhone();

        $cardToken = $this->previousApi->getTokensClient()->requestCardToken($cardTokenRequest);

        $instrumentAccountHolder = new InstrumentAccountHolder();
        $instrumentAccountHolder->billing_address = $this->getAddress();
        $instrumentAccountHolder->phone = $this->getPhone();

        $createInstrumentRequest = new CreateInstrumentRequest();
        $createInstrumentRequest->type = InstrumentType::$token;
        $createInstrumentRequest->token = $cardToken["token"];
        $createInstrumentRequest->account_holder = $instrumentAccountHolder;

        $instrumentsResponse = $this->previousApi->getInstrumentsClient()->create($createInstrumentRequest);

        $idSourcePrism = new IdSourcePrism();
        $idSourcePrism->id = $instrumentsResponse["id"];
        $idSourcePrism->cvv = TestCardSource::$VisaCvv;

        $this->doAuthenticationAssessmentRequest($idSourcePrism);
        $this->doPreCaptureAssessmentRequest($idSourcePrism);
    }

    /**
     * @test
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    public function shouldPreCaptureAndAuthenticateToken()
    {
        $cardTokenRequest = new CardTokenRequest();
        $cardTokenRequest->name = TestCardSource::$VisaName;
        $cardTokenRequest->number = TestCardSource::$VisaNumber;
        $cardTokenRequest->expiry_year = TestCardSource::$VisaExpiryYear;
        $cardTokenRequest->expiry_month = TestCardSource::$VisaExpiryMonth;
        $cardTokenRequest->cvv = TestCardSource::$VisaCvv;
        $cardTokenRequest->billing_address = $this->getAddress();
        $cardTokenRequest->phone = $this->getPhone();

        $cardToken = $this->previousApi->getTokensClient()->requestCardToken($cardTokenRequest);

        $riskRequestTokenSource = new RiskRequestTokenSource();
        $riskRequestTokenSource->token = $cardToken["token"];
        $riskRequestTokenSource->phone = $this->getPhone();
        $riskRequestTokenSource->billing_address = $this->getAddress();

        $this->doAuthenticationAssessmentRequest($riskRequestTokenSource);
        $this->doPreCaptureAssessmentRequest($riskRequestTokenSource);
    }

    /**
     * @param \Checkout\Tamara\Risk\Source\RiskPaymentRequestSource $requestSource
     * @throws CheckoutApiException
     */
    private function doAuthenticationAssessmentRequest(RiskPaymentRequestSource $requestSource)
    {
        $customerRequest = new CustomerRequest();
        $customerRequest->email = $this->randomEmail();
        $customerRequest->name = "name";

        $preAuthenticationAssessmentRequest = new PreAuthenticationAssessmentRequest();
        $preAuthenticationAssessmentRequest->date = new DateTime();
        $preAuthenticationAssessmentRequest->source = $requestSource;
        $preAuthenticationAssessmentRequest->customer = $customerRequest;
        $preAuthenticationAssessmentRequest->payment = $this->getRiskPayment();
        $preAuthenticationAssessmentRequest->shipping = $this->getRiskShippingDetails();
        $preAuthenticationAssessmentRequest->reference = "ORD-1011-87AH";
        $preAuthenticationAssessmentRequest->description = "Set of 3 masks";
        $preAuthenticationAssessmentRequest->amount = 6540;
        $preAuthenticationAssessmentRequest->currency = Currency::$GBP;
        $preAuthenticationAssessmentRequest->device = $this->getDevice();
        $preAuthenticationAssessmentRequest->metadata = array("VoucherCode" => "loyalty_10", "discountApplied" => "10", "customer_id" => "2190EF321");

        $response = $this->previousApi->getRiskClient()->requestPreAuthenticationRiskScan($preAuthenticationAssessmentRequest);
        $this->assertResponse(
            $response,
            "assessment_id",
            "result",
            "result.decision",
            //"result.details",
            "_links"
        );
    }

    /**
     * @param RiskPaymentRequestSource $requestSource
     * @throws \Checkout\Tamara\CheckoutApiException
     */
    private function doPreCaptureAssessmentRequest(RiskPaymentRequestSource $requestSource)
    {
        $customerRequest = new CustomerRequest();
        $customerRequest->email = $this->randomEmail();
        $customerRequest->name = "name";

        $authenticationResult = new AuthenticationResult();
        $authenticationResult->attempted = true;
        $authenticationResult->challenged = true;
        $authenticationResult->liability_shifted = true;
        $authenticationResult->method = "3ds";
        $authenticationResult->succeeded = true;
        $authenticationResult->version = "2.0";

        $authorizationResult = new AuthorizationResult();
        $authorizationResult->avs_code = "V";
        $authorizationResult->cvv_result = "N";

        $preCaptureAssessmentRequest = new PreCaptureAssessmentRequest();
        $preCaptureAssessmentRequest->date = new DateTime();
        $preCaptureAssessmentRequest->source = $requestSource;
        $preCaptureAssessmentRequest->customer = $customerRequest;
        $preCaptureAssessmentRequest->payment = $this->getRiskPayment();
        $preCaptureAssessmentRequest->shipping = $this->getRiskShippingDetails();
        $preCaptureAssessmentRequest->amount = 6540;
        $preCaptureAssessmentRequest->currency = Currency::$GBP;
        $preCaptureAssessmentRequest->device = $this->getDevice();
        $preCaptureAssessmentRequest->metadata = array("VoucherCode" => "loyalty_10", "discountApplied" => "10", "customer_id" => "2190EF321");
        $preCaptureAssessmentRequest->authentication_result = $authenticationResult;
        $preCaptureAssessmentRequest->authorization_result = $authorizationResult;

        $response = $this->previousApi->getRiskClient()->requestPreCaptureRiskScan($preCaptureAssessmentRequest);
        $this->assertResponse(
            $response,
            "assessment_id",
            "result",
            "result.decision",
            //"result.details",
            "_links"
        );
    }

    /**
     * @return \Checkout\Tamara\Risk\RiskShippingDetails
     */
    private function getRiskShippingDetails()
    {
        $riskShippingDetails = new RiskShippingDetails();
        $riskShippingDetails->address = $this->getAddress();

        return $riskShippingDetails;
    }

    /**
     * @return Device
     */
    private function getDevice()
    {
        $location = new Location();
        $location->latitude = "51.5107";
        $location->longitude = "0.1313";

        $device = new Device();
        $device->location = $location;
        $device->type = "Phone";
        $device->os = "ISO";
        $device->model = "iPhone X";
        $device->date = new DateTime();
        $device->user_agent = "Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1";
        $device->fingerprint = "34304a9e3fg09302";
        return $device;
    }

    /**
     * @return RiskPayment
     */
    private function getRiskPayment()
    {
        $riskPayment = new RiskPayment();
        $riskPayment->psp = "CheckoutSdk.com";
        $riskPayment->id = "78453878";
        return $riskPayment;
    }

}
