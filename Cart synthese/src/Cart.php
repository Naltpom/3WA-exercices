<?php

declare(strict_types=1);

namespace App;

class Cart
{
    public function __construct(
        private Storable $storage,
        private ?float $tva = null
    ) {
        $this->tva = $tva ?? (float) $_ENV['TVA'];
    }

    public function buy(Productable $product, int $quantity): void
    {
        $total = $product->getPrice() * ($this->tva  + 1) * $quantity;

        $this->storage->setValue($product->getName(), $total);
    }

    public function restore(Productable $product): void
    {
        $this->storage->restore($product->getName());
    }

    public function total(): float
    {
        return $this->storage->total();
    }
}
