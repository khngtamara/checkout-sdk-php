<?php

namespace Checkout\Tamara\Metadata\Card\Source;

use Checkout\Tamara\Metadata\Card\Source\CardMetadataRequestSource;
use Checkout\Tamara\Metadata\Card\Source\CardMetadataSourceType;

class CardMetadataTokenSource extends CardMetadataRequestSource
{
    /**
     * @var string
     */
    public $token;

    public function __construct()
    {
        parent::__construct(CardMetadataSourceType::$TOKEN);
    }
}
