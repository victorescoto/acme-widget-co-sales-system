<?php

declare(strict_types=1);

namespace Acme\Widget\Delivery;

use Acme\Widget\Interfaces\DeliveryRuleStrategyInterface;

class FreeDeliveryRule implements DeliveryRuleStrategyInterface
{
    public function appliesTo(float $total): bool
    {
        return $total >= 90;
    }

    public function getCharge(): float
    {
        return 0.0;
    }
}
