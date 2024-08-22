<?php

/**
 * This is a playground file to test the all the classes and methods.
 *
 * Run the file using the following command:
 *
 * php playground.php
 */

declare(strict_types=1);

require 'vendor/autoload.php';

use Acme\Widget\Basket;
use Acme\Widget\Product;
use Acme\Widget\Delivery\LowCostDeliveryRule;
use Acme\Widget\Delivery\MidCostDeliveryRule;
use Acme\Widget\Delivery\FreeDeliveryRule;
use Acme\Widget\Offer\BuyOneGetOneHalfPriceOffer;

$redWidget = new Product(
    code: 'R01',
    name: 'Red Widget',
    price: 32.95
);

$blueWidget = new Product(
    code: 'B01',
    name: 'Blue Widget',
    price: 7.95
);

$greenWidget = new Product(
    code: 'G01',
    name: 'Green Widget',
    price: 24.95
);

$deliveryRules = [
    new LowCostDeliveryRule,
    new MidCostDeliveryRule,
    new FreeDeliveryRule
];

$specialOffers = [
    new BuyOneGetOneHalfPriceOffer($redWidget)
];

$basket = new Basket(deliveryRules: $deliveryRules, specialOffers: $specialOffers);
$basket->add($redWidget);
$basket->add($redWidget);
$basket->add($greenWidget);


echo "Total: $" . $basket->total() . PHP_EOL;
echo "Offers Applied:" . PHP_EOL;
foreach ($basket->getOfferTitles() as $title) {
    echo "- {$title}" . PHP_EOL;
}
