<?php

namespace Checkout\Tamara\Metadata\Card\Source;

use Checkout\Tamara\Metadata\Card\Source\CardMetadataRequestSource;
use Checkout\Tamara\Metadata\Card\Source\CardMetadataSourceType;

class CardMetadataCardSource extends CardMetadataRequestSource
{
    /**
     * @var string
     */
    public $number;

    public function __construct()
    {
        parent::__construct(CardMetadataSourceType::$CARD);
    }
}
