<?php

declare(strict_types=1);

namespace Acme\Widget\Interfaces;

use Acme\Widget\Product;

interface SpecialOfferStrategyInterface
{
    /**
     * @param Product[] $products
     */
    public function apply(array $products): float;

    /**
     * @return string
     */
    public function getTitle(): string;
}
