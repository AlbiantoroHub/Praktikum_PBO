<?php

class Product {
    private $nama;
    private $harga;
    private $kategori;

    public function __construct($nama, $harga, $kategori) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->kategori = $kategori;
    }

    public function getInfo() {
        echo "Nama Produk: {$this->nama} <br>";
        echo "Kategori: {$this->kategori} <br>";
        echo "Harga: Rp " . number_format($this->harga, 0, ',', '.') . "<br><br>";
    }

    public function applyDiskon($persen) {
        $nilaiDiskon = ($this->harga * $persen) / 100;
        $this->harga -= $nilaiDiskon;
        echo "<i>Produk {$this->nama} telah mendapatkan diskon sebesar {$persen}%.</i><br>";
    }
}

$produk1 = new Product("Laptop ASUS ROG", 150000000, "Laptop");
$produk2 = new Product("Mouse Logitech", 1200000, "Mouse");

echo "<b>[ DAFTAR PRODUK AWAL ]</b><br>";
$produk1->getInfo();
$produk2->getInfo();

echo "<b>[ PROSES DISKON ]</b><br>";
$produk1->applyDiskon(25); 
$produk2->applyDiskon(10); 
echo "<br>";

echo "<b>[ DAFTAR PRODUK SETELAH DISKON ]</b><br>";
$produk1->getInfo();
$produk2->getInfo();

?>