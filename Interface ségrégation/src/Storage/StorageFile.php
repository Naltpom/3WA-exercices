<?php

declare(strict_types=1);

namespace App\Storage;

class StorageFile implements StorageInterface
{
    private string $fileName;

    public function __construct()
    {
        $this->fileName = $_ENV['FILES_DIR'] . uniqid('storage-', true) . '.json';
        file_put_contents($this->fileName, '');
    }

    public function setValue(string $name, float $total): void
    {
        $file = json_decode(file_get_contents($this->fileName, true), true);
        $file[$name] = ($file[$name] ?? 0) + $total;

        file_put_contents($this->fileName, json_encode($file));
    }

    public function total(): float
    {
        return round(array_sum(json_decode(file_get_contents($this->fileName, true), true)), (int) $_ENV['PRECISION']);
    }
}
