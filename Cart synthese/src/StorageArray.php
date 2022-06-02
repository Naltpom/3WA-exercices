<?php

declare(strict_types=1);

namespace App;

class StorageArray implements Storable
{
    private array $storage = [];

    public function setValue(string $name, float $price): void
    {
        $this->storage[$name] = ($this->storage[$name] ?? 0) + $price;
    }

    /**
     * Reset session Card
     */
    public function reset(): void
    {
        unset($this->storage);
    }


    public function total(): float
    {
        return round(array_sum($this->storage), (int) $_ENV['PRECISION']);
    }

    /**
     * Remove from session Card a Product by name
     */
    public function restore(string $name): void
    {
        unset($this->storage[$name]);
    }
}
