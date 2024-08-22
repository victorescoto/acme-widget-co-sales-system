<?php

declare(strict_types=1);

namespace Acme\Widget\Offer;

use Acme\Widget\Interfaces\SpecialOfferStrategyInterface;
use Acme\Widget\Product;

class BuyOneGetOneHalfPriceOffer implements SpecialOfferStrategyInterface
{
    public function __construct(
        private readonly Product $product
    ) {}

    public function getTitle(): string
    {
        return "Buy one {$this->product->name}, get the second half price";
    }

    public function apply(array $products): float
    {
        $applicableProducts = array_values(array_filter(
            $products,
            fn($product) => $product->code === $this->product->code
        ));

        if (count($applicableProducts) >= 2) {
            $discountedItems = intdiv(count($applicableProducts), 2);
            $discount = $discountedItems * $applicableProducts[0]->price * 0.5;
            return round($discount, 2);
        }

        return 0.0;
    }
}
