<?php

declare(strict_types=1);

namespace App;

use App\Storage\StorageInterface;

class Cart
{
    public function __construct(
        private StorageInterface $storage,
        private float $tva = 0
    ) {
    }

    public function buy(ProductInterface $product, int $quantity): void
    {
        $total = $product->getPrice() * ($this->tva  + 1) * $quantity;

        $this->storage->setValue($product->getName(), $total);
    }

    public function total(): float
    {
        return $this->storage->total();
    }
}
