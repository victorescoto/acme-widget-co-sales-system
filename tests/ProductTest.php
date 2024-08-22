<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\Widget\Product;

class ProductTest extends TestCase
{
    public function testProductCreation(): void
    {
        $product = new Product('R01', 'Red Widget', 32.95);

        $this->assertSame('R01', $product->code);
        $this->assertSame('Red Widget', $product->name);
        $this->assertSame(32.95, $product->price);
    }
}
