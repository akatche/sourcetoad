<?php

namespace Sourcetoad\Ecommerce\ShippingRate;

use Sourcetoad\Ecommerce\Address;

class ApiShippingRate implements ShippingRateService
{
    public function getShippingRate(Address $address): int
    {
        return 3;
    }
}
