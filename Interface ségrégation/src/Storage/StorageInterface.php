<?php

declare(strict_types=1);

namespace App\Storage;

interface StorageInterface
{
    public function setValue(string $name, float $total): void;
    public function total(): float;
}
