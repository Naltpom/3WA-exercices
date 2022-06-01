<?php

declare(strict_types=1);


foreach (glob('./StorageFiles/*') as $file) {
    unlink($file);
}

require_once __DIR__ . './vendor/autoload.php';

use Config\Init;
$init = new Init();

$pdo = $init->resetPdo();
$pdo = $init->getPdo();

const PRECISION = 2;
const TVA = .2;

use App\Cart;
use App\Products\{Bike, Book, Music};
use App\Storage\{StorageArray, StorageFile, StorageSession, StorageDb};

$products = [
    new Book('Moby Dick', 30),
    new Bike('Brompton', 1430),
    new Music('AC/DC', 17.5),
];

/** 
 * @var StorageFile 
 * # $carts[] = new Cart(new StorageFile(), TVA);
 * # $carts[] = new Cart(new StorageFile());
 */
$carts[] = new Cart(new StorageFile(), TVA);

/** 
 * @var StorageArray 
 * # $carts[] = new Cart(new StorageArray(), TVA);
 * # $carts[] = new Cart(new StorageArray());
 */
$carts[] = new Cart(new StorageArray(), TVA);

/** 
 * @var StorageSession 
 * # $carts[] = new Cart(new StorageSession(), TVA);
 * # $carts[] = new Cart(new StorageSession());
 */
$carts[] = new Cart(new StorageSession(), TVA);

/** 
 * @var StorageDb 
 * # $carts[] = new Cart(new StorageDb(), TVA);
 * # $carts[] = new Cart(new StorageDb());
 */
$carts[] = new Cart(new StorageDb($init->getPdo()), TVA);

foreach ($carts as $cart) {
    foreach ($products as $product)
        $cart->buy($product, 5);
    echo  $cart->total()  . "\n"; // 7387.5
}

/**
 * No TVA
 * Book  : 5 * 30 = 150
 * Bike  : 5 * 1430 = 7150
 * Music : 5 * 17.5 = 87.5
 * 
 * Total : 150 + 7150 + 87.5 = 7387.5
 */
