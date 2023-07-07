<?php

namespace Sourcetoad\Ecommerce;

use Sourcetoad\Ecommerce\ShippingRate\ShippingRateService;

class Cart
{

    const TAX_RATE = 7;

    private array $items = [];

    public function __construct(
        private Customer            $customer,
        private ShippingRateService $shippingRate
    )
    {
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(Item $items): void
    {
        $this->items[] = $items;
    }

    public function getShippingAddress(): Address
    {
        return $this->customer->getDefaultAddress();
    }

    private function getShippingCost(): int
    {
        return $this->shippingRate->getShippingRate($this->getShippingAddress());
    }

    private function getTaxCost()
    {
        return self::TAX_RATE;
    }

    public function calculateTotalCostOfItem(Item $item) : string{

        if(!$this->isItemOnCart($item)){
            throw new \Exception('Item is not on cart');
        }

        //I´m assuming that the tax and the shipping cost are percentages
        $total = $item->calculateTotal(
            $this->getTaxCost(),
            $this->getShippingCost()
        );

        $formatter = new \NumberFormatter('en-US',\NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($total,'USD');
    }

    private function isItemOnCart(Item $item) : bool
    {
        $filtered_array = array_filter($this->items, function ($data) use ($item) {
            return $data->getId() === $item->getId();
        });

        if (count($filtered_array) === 0) {
            return false;
        }

        return true;
    }

    public function calculateSubtotal() : string{

        $total = 0;

        foreach ($this->items as $item){

            $total+= $item->calculateSubTotal();
        }

        $formatter = new \NumberFormatter('en-US',\NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($total,'USD');
    }

    public function calculateTotal() : string{

        $total = 0;

        foreach ($this->items as $item){

            $total+= $item->calculateTotal($this->getTaxCost(),$this->getShippingCost());
        }

        $formatter = new \NumberFormatter('en-US',\NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($total,'USD');
    }

}
