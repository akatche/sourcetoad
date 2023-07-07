<?php

namespace Sourcetoad\Ecommerce;

class Item
{

    public function __construct(
        private int    $id,
        private string $name,
        private int    $quantity,
        private int    $price,
    )
    {}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function calculateSubTotal(): float{
        return ($this->getQuantity() * $this->getPrice())/100;
    }

    public function calculateTotal($tax = 0, $shipping = 0): float{
        $subtotal = $this->calculateSubTotal();
        $extras = ($subtotal * ($tax + $shipping) / 100);
        return $subtotal + $extras;
    }
}
