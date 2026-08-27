<?php

class persegipanjang{
    public $panjang;
    public $lebar;

    public function luas(){
        return $this->panjang * $this->lebar;
    }
}
$perhitungan = new persegipanjang();
$perhitungan->panjang = 10;
$perhitungan->lebar = 5;
echo "Luas Persegi Panjang 1: " . $perhitungan->luas();

echo "<br>";

$perhitungan2 = new persegipanjang();
$perhitungan2->panjang = 15;
$perhitungan2->lebar = 10;
echo "Luas Persegi Panjang 2: " . $perhitungan2->luas();