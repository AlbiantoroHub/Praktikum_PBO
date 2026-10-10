<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\ProductService;


try {
    $service = new ProductService();


    $product1 = $service->createProduct('Laptop ASUS ROG', 25000000);
    $product2 = $service->createProduct('Mechanical Keyboard', 850000);

    echo "<h3>Daftar Produk:</h3>";
    echo $service->displayProduct($product1) . "<br>";
    echo $service->displayProduct($product2) . "<br>";

} catch (Throwable $e) {

    echo "<h3>Terjadi Error</h3>";
    echo "<p>Pesan: " . $e->getMessage() . "</p>";
    echo "<p>File: " . $e->getFile() . "</p>";
    echo "<p>Line: " . $e->getLine() . "</p>";
}