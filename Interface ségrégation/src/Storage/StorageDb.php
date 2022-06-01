<?php

declare(strict_types=1);

namespace App\Storage;

use Config\Init;

class StorageDb implements StorageInterface
{
    private array $storage = [];
    private string $ref;

    public function __construct(
        private \Pdo $pdo
    ) {
        $this->ref = uniqid(more_entropy: true);
    }

    public function setValue(string $name, float $total): void
    {
        $requete = $this->pdo->prepare("INSERT INTO storage (name, total, ref) VALUES (:name, :total, :ref)");
        $requete->execute([':ref' => $this->ref, ':name' => $name, ':total' => (float) $total]);

        $this->storage[$name] = $this->storage[$name] ?? 0 + $total;
    }

    public function total(): float
    {
        $requete = $this->pdo->prepare("SELECT * FROM storage WHERE ref = :ref");
        $requete->execute([':ref' => $this->ref]);
        $resultats = $requete->fetchAll(\PDO::FETCH_ASSOC);
        $total = 0;
        foreach ($resultats as $value) {
            $total = $total + $value['total'];
        }
        return round($total, PRECISION);
    }
}
