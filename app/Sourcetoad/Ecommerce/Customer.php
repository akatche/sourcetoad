<?php

namespace Sourcetoad\Ecommerce;

class Customer
{

    private array $addresses = [];

    private Address $defaultAddress;

    public function __construct(
        private string $first_name,
        private string $last_name,
    )
    {
    }

    public function setAddress(Address $address,bool $default = false): void
    {
        $this->addresses[] = $address;

        if($default){
            $this->setDefaultAddress($address);
        }
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

    public function getName(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * @return Address
     */
    public function getDefaultAddress(): Address
    {
        return $this->defaultAddress;
    }

    /**
     * @param Address $address
     */
    private function setDefaultAddress(Address $address): void
    {
        $this->defaultAddress = $address;
    }
}
