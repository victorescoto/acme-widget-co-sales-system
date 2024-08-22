<?php

declare(strict_types=1);

namespace Acme\Widget\Interfaces;

interface DeliveryRuleStrategyInterface
{
    public function appliesTo(float $total): bool;
    public function getCharge(): float;
}
