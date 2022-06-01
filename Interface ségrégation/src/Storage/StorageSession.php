<?php

declare(strict_types=1);

namespace App\Storage;

class StorageSession implements StorageInterface
{
    public function setValue(string $name, float $total): void
    {
        $_SESSION[$name] = $_SESSION[$name] ?? 0 + $total;
    }

    public function total(): float
    {
        return round(array_sum($_SESSION), PRECISION);
    }
}
