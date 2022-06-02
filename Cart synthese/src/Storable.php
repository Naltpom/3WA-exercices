<?php

declare(strict_types=1);

namespace App;

interface Storable
{
    public function setValue(string $name, float $total): void;
    public function reset(): void;
    public function total(): float;
    public function restore(string $name): void;
}
