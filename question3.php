<?php

require './app/bootstrap.php';

use Sourcetoad\Ecommerce\Address;
use Sourcetoad\Ecommerce\Cart;
use Sourcetoad\Ecommerce\Customer;
use Sourcetoad\Ecommerce\Item;

$houseAddress = new Address('House 123','street2','Miami','Florida','14136');
$workAddress = new Address('Work 123','street2','Miami','Florida','14145');
$customer = new Customer('Alejandro','Katcheroff');
$customer->setAddress($houseAddress, true);
$customer->setAddress($workAddress);

//Customer Name
print_r($customer->getName());

//Customer Addresses
print_r($customer->getAddresses());

//I´m storing money as integer $25.35 => 2535
$ballItem = new Item(1,'Ball',1,1500);
$toyItem = new Item(2,'Toy',10,2500);
$cart = new Cart($customer, new \Sourcetoad\Ecommerce\ShippingRate\ApiShippingRate());
$cart->addItem($ballItem);
$cart->addItem($toyItem);

//Items in Cart
print_r($cart->getItems());

//Where Order Ships
print_r($cart->getShippingAddress());

//Cost of item in cart, including shipping and tax
try {
    $cost = $cart->calculateTotalCostOfItem($toyItem);
    echo "Item cost is $cost";
}catch (Exception $exception){
    echo $exception->getMessage();
}

//Subtotal all items
try {
    $subtotal = $cart->calculateSubtotal();
    echo "Cart subtotal is $subtotal";
}catch (Exception $exception){
    echo $exception->getMessage();
}

//total all items
try {
    $cartTotal = $cart->calculateTotal();
    echo "Cart total is $cartTotal";
}catch (Exception $exception){
    echo $exception->getMessage();
}
