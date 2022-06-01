<?php

declare(strict_types=1);

namespace App\Storage;

class StorageArray implements StorageInterface
{
    private array $storage = [];

    public function setValue(string $name, float $total): void
    {
        $this->storage[$name] = ($this->storage[$name] ?? 0) + $total;
    }

    public function total(): float
    {
        return round(array_sum($this->storage), (int) $_ENV['PRECISION']);
    }
}
