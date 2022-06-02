<?php

declare(strict_types=1);

require_once __DIR__ . './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

use App\{Cart, Product, StorageSession, StorageArray};

// création des produits
$products = [
    'apple' => new Product('apple', 10.5),
    'raspberry' => new Product('raspberry', 13),
    'strawberry' => new Product('strawberry', 7.5),
    'orange' => new Product('orange', 7.5),
];

$carts[] = new Cart(new StorageSession());
$carts[] = new Cart(new StorageArray());

extract($products);
foreach ($carts as $key => $cart) {
    $cart->buy($apple, 3);
    $cart->buy($apple, 4);
    $cart->buy($apple, 5);
    $cart->buy($strawberry, 10);

    echo PHP_EOL . "Cart $key"; // 241.2
    echo PHP_EOL . $cart->total() . PHP_EOL; // 241.2
    // retire un produit du panier
    echo "restore strawberry";
    $cart->restore($strawberry);
    echo PHP_EOL . $cart->total() . PHP_EOL; // 151.2
}
