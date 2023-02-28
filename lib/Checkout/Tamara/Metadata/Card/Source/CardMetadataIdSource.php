<?php

namespace Checkout\Tamara\Metadata\Card\Source;

use Checkout\Tamara\Metadata\Card\Source\CardMetadataRequestSource;
use Checkout\Tamara\Metadata\Card\Source\CardMetadataSourceType;

class CardMetadataIdSource extends CardMetadataRequestSource
{
    /**
     * @var string
     */
    public $id;

    public function __construct()
    {
        parent::__construct(CardMetadataSourceType::$ID);
    }
}
