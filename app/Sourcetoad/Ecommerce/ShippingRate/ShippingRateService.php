<?php

namespace Sourcetoad\Ecommerce\ShippingRate;

use Sourcetoad\Ecommerce\Address;

interface ShippingRateService
{
    //I´m assuming that on this case the shipping rate depends only on the distance
    public function getShippingRate(Address $address): int;
}
