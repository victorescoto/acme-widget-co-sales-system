<?php

declare(strict_types=1);

namespace Acme\Widget;

class Product
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly float $price
    ) {}
}
