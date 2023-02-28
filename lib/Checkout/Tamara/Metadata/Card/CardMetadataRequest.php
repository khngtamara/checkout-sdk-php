<?php

namespace Checkout\Tamara\Metadata\Card;

use Checkout\Tamara\Metadata\Card\Source\CardMetadataRequestSource;

class CardMetadataRequest
{
    /**
     * @var CardMetadataRequestSource
     */
    public $source;
    /**
     * @var string value of CardMetadataFormatType
     */
    public $format;
}
