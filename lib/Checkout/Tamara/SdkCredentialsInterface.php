<?php

namespace Checkout\Tamara;

interface SdkCredentialsInterface
{
    public function getAuthorization($authorizationType);
}
