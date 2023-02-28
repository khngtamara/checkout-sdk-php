<?php

namespace Checkout\Tamara\Instruments\Update;

use Checkout\Tamara\Common\InstrumentType;
use Checkout\Tamara\Instruments\Update\UpdateInstrumentRequest;

class UpdateTokenInstrumentRequest extends UpdateInstrumentRequest
{
    public function __construct()
    {
        parent::__construct(InstrumentType::$token);
    }

    /**
     * @var string
     */
    public $token;
}
