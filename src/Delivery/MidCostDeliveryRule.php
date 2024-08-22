<?php

declare(strict_types=1);

namespace Acme\Widget\Delivery;

use Acme\Widget\Interfaces\DeliveryRuleStrategyInterface;

class MidCostDeliveryRule implements DeliveryRuleStrategyInterface
{
    public function appliesTo(float $total): bool
    {
        return $total >= 50 && $total < 90;
    }

    public function getCharge(): float
    {
        return 2.95;
    }
}
