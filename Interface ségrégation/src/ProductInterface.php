<?php

declare(strict_types=1);

namespace App;

interface ProductInterface
{
    public function getPrice(): float;
    public function setPrice(float $price): void;
    public function getName(): string;
}
