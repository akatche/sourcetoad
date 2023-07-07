<?php

namespace Sourcetoad\Ecommerce;

class Address
{
    public function __construct(
        private string $line_1,
        private string $line_2,
        private string $city,
        private string $state,
        private string $zip
    )
    {
    }
}
