<?php

namespace Checkout\Tamara\Metadata\Card\Source;

use Checkout\Tamara\Metadata\Card\Source\CardMetadataRequestSource;
use Checkout\Tamara\Metadata\Card\Source\CardMetadataSourceType;

class CardMetadataBinSource extends CardMetadataRequestSource
{
    /**
     * @var string
     */
    public $bin;

    public function __construct()
    {
        parent::__construct(CardMetadataSourceType::$BIN);
    }
}
