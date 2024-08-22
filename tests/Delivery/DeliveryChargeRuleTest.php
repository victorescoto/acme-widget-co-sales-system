<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\Widget\Delivery\LowCostDeliveryRule;
use Acme\Widget\Delivery\MidCostDeliveryRule;
use Acme\Widget\Delivery\FreeDeliveryRule;

class DeliveryChargeRuleTest extends TestCase
{
    public function testLowCostDeliveryRuleAppliesCorrectly(): void
    {
        $rule = new LowCostDeliveryRule();

        $this->assertTrue($rule->appliesTo(49.99));
        $this->assertFalse($rule->appliesTo(50.00));
        $this->assertSame(4.95, $rule->getCharge());
    }

    public function testMidCostDeliveryRuleAppliesCorrectly(): void
    {
        $rule = new MidCostDeliveryRule();

        $this->assertTrue($rule->appliesTo(50.00));
        $this->assertTrue($rule->appliesTo(89.99));
        $this->assertFalse($rule->appliesTo(90.00));
        $this->assertSame(2.95, $rule->getCharge());
    }

    public function testFreeDeliveryRuleAppliesCorrectly(): void
    {
        $rule = new FreeDeliveryRule();

        $this->assertTrue($rule->appliesTo(90.00));
        $this->assertTrue($rule->appliesTo(150.00));
        $this->assertFalse($rule->appliesTo(89.99));
        $this->assertSame(0.0, $rule->getCharge());
    }
}
