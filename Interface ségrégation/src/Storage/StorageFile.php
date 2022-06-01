<?php

declare(strict_types=1);

namespace App\Storage;

class StorageFile implements StorageInterface
{
    private array $storage = [];
    private string $fileName;

    public function __construct()
    {
        $this->fileName = './StorageFiles/' . uniqid('storage-', true) . '.json';
    }

    public function setValue(string $name, float $total): void
    {
        $this->storage[$name] = $this->storage[$name] ?? 0 + $total;
        file_put_contents($this->fileName, json_encode($this->storage));
    }

    public function total(): float
    {
        return round(array_sum(json_decode(file_get_contents($this->fileName, true), true)), PRECISION);
    }
}
