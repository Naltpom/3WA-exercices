<?php

declare(strict_types=1);

namespace App;

class StorageSession implements Storable
{
    public function setValue(string $name, float $total): void
    {
        $_SESSION[$name] = ($_SESSION[$name] ?? 0) + $total;
    }

    /**
     * Reset session Card
     */
    public function reset(): void
    {
        unset($_SESSION);
    }


    public function total(): float
    {
        return round(array_sum($_SESSION), (int) $_ENV['PRECISION']);
    }

    /**
     * Remove from session Card a Product by name
     */
    public function restore(string $name): void
    {
        unset($_SESSION[$name]);
    }
}
