<?php

namespace Checkout\Tamara\Transfers;

use Checkout\Tamara\Transfers\TransferDestination;
use Checkout\Tamara\Transfers\TransferSource;

class CreateTransferRequest
{
    /**
     * @var string
     */
    public $reference;

    /**
     * @var string value of TransferType
     */
    public $transfer_type;

    /**
     * @var TransferSource
     */
    public $source;

    /**
     * @var TransferDestination
     */
    public $destination;
}
