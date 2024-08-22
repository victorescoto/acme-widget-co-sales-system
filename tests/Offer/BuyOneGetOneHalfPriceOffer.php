<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\Widget\Product;
use Acme\Widget\Offer\BuyOneGetOneHalfPriceOffer;

class BuyOneGetOneHalfPriceOfferTest extends TestCase
{
    public function testApplyDiscount(): void
    {
        $redWidgetData = [
            'code' => 'R01',
            'name' => 'Red Widget',
            'price' => 32.95
        ];
        $offer = new BuyOneGetOneHalfPriceOffer(new Product(...$redWidgetData));

        $products = [
            new Product(...$redWidgetData),
            new Product(...$redWidgetData),
        ];

        $discount = $offer->apply($products);

        $this->assertSame(16.48, $discount);
    }
}
