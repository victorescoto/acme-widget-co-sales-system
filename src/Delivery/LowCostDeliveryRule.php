<?php

declare(strict_types=1);

namespace Acme\Widget\Delivery;

use Acme\Widget\Interfaces\DeliveryRuleStrategyInterface;

class LowCostDeliveryRule implements DeliveryRuleStrategyInterface
{
    public function appliesTo(float $total): bool
    {
        return $total < 50;
    }

    public function getCharge(): float
    {
        return 4.95;
    }
}
