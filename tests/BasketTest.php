<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\Widget\Basket;
use Acme\Widget\Product;
use Acme\Widget\Delivery\LowCostDeliveryRule;
use Acme\Widget\Delivery\MidCostDeliveryRule;
use Acme\Widget\Delivery\FreeDeliveryRule;
use Acme\Widget\Offer\BuyOneGetOneHalfPriceOffer;

class BasketTest extends TestCase
{
    private array $redWidgetData;
    private array $blueWidgetData;
    private array $greenWidgetData;
    private array $deliveryRules;
    private array $specialOffers;

    protected function setUp(): void
    {
        $this->redWidgetData = [
            'code' => 'R01',
            'name' => 'Red Widget',
            'price' => 32.95
        ];
        $this->blueWidgetData = [
            'code' => 'B01',
            'name' => 'Blue Widget',
            'price' => 7.95
        ];
        $this->greenWidgetData = [
            'code' => 'G01',
            'name' => 'Green Widget',
            'price' => 24.95
        ];

        $this->deliveryRules = [
            new LowCostDeliveryRule,
            new MidCostDeliveryRule,
            new FreeDeliveryRule
        ];

        $this->specialOffers = [
            new BuyOneGetOneHalfPriceOffer(new Product(...$this->redWidgetData))
        ];
    }

    public function testBasketTotalWithB01AndG01(): void
    {
        $basket = new Basket($this->deliveryRules, $this->specialOffers);

        $basket->add(new Product(...$this->blueWidgetData));
        $basket->add(new Product(...$this->greenWidgetData));

        $this->assertSame(37.85, $basket->total());
    }

    public function testBasketTotalWithTwoR01(): void
    {
        $basket = new Basket($this->deliveryRules, $this->specialOffers);

        $basket->add(new Product(...$this->redWidgetData));
        $basket->add(new Product(...$this->redWidgetData));

        $this->assertSame(54.37, $basket->total());
    }

    public function testBasketTotalWithR01AndG01(): void
    {
        $basket = new Basket($this->deliveryRules, $this->specialOffers);

        $basket->add(new Product(...$this->redWidgetData));
        $basket->add(new Product(...$this->greenWidgetData));

        $this->assertSame(60.85, $basket->total());
    }

    public function testBasketTotalWithMultipleItems(): void
    {
        $basket = new Basket($this->deliveryRules, $this->specialOffers);

        $basket->add(new Product(...$this->blueWidgetData));
        $basket->add(new Product(...$this->blueWidgetData));
        $basket->add(new Product(...$this->redWidgetData));
        $basket->add(new Product(...$this->redWidgetData));
        $basket->add(new Product(...$this->redWidgetData));

        $this->assertSame(98.27, $basket->total());
    }
}
