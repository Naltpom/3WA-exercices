<?php

declare(strict_types=1);

namespace App;

abstract class Product implements ProductInterface
{
    public function __construct(
        private string $name,
        private float $price
    ) {
    }

    public function getPrice(): float
    {
        return round($this->price, PRECISION);
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
