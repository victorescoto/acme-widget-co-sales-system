<?php

declare(strict_types=1);

namespace Acme\Widget;

use Acme\Widget\Interfaces\DeliveryRuleStrategyInterface;
use Acme\Widget\Interfaces\SpecialOfferStrategyInterface;

class Basket
{
    /** @var Product[] */
    private array $products = [];

    /**
     * @param DeliveryRuleStrategyInterface[] $deliveryRules
     * @param SpecialOfferStrategyInterface[] $specialOffers
     */
    public function __construct(
        private readonly array $deliveryRules,
        private readonly array $specialOffers
    ) {}

    public function add(Product $product): void
    {
        $this->products[] = $product;
    }

    public function total(): float
    {
        $subtotal = array_sum(array_map(fn($product) => $product->price, $this->products));
        $totalDiscount = array_sum(array_map(fn($offer) => $offer->apply($this->products), $this->specialOffers));

        $finalTotal = $subtotal - $totalDiscount;

        foreach ($this->deliveryRules as $rule) {
            if ($rule->appliesTo($finalTotal)) {
                $finalTotal += $rule->getCharge();
                break;
            }
        }

        return round($finalTotal, 2);
    }

    /**
     * @return string[]
     */
    public function getOfferTitles(): array
    {
        return array_map(fn($offer) => $offer->getTitle(), $this->specialOffers);
    }
}
