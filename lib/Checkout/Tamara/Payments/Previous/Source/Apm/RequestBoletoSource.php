<?php

namespace Checkout\Tamara\Payments\Previous\Source\Apm;

use Checkout\Tamara\Common\PaymentSourceType;
use Checkout\Tamara\Payments\Payer;
use Checkout\Tamara\Payments\Previous\Source\AbstractRequestSource;
use Checkout\Tamara\Payments\Previous\Source\Apm\IntegrationType;

class RequestBoletoSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$boleto);
        $this->integration_type = IntegrationType::$redirect;
    }

    /**
     * @var string value of IntegrationType
     */
    public $integration_type;

    /**
     * @var string values of Country
     */
    public $country;

    /**
     * @var string
     */
    public $description;

    /**
     * @var \Checkout\Tamara\Payments\Payer
     */
    public $payer;
}
