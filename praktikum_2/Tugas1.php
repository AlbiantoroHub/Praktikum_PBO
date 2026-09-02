<?php

class Mobil {
    public $merek;
    public $warna;
    public $kecepatan;

    public function __construct($merek, $warna, $kecepatan) {
        $this->merek = $merek;
        $this->warna = $warna;
        $this->kecepatan = $kecepatan;
    }

    public function getInfo() {
        return "Mobil merek {$this->merek} berwarna {$this->warna} melaju dengan kecepatan {$this->kecepatan} km/jam.<br>";
    }

    public function jalankan() {
        echo "Mobil berjalan...<br>";
    }

    public function berhenti() {
        echo "Mobil berhenti.<br><br>";
    }
}

$mobil1 = new Mobil("Toyota", "Merah", 80);
$mobil2 = new Mobil("Honda", "Hitam", 100);
$mobil3 = new Mobil("Suzuki", "Putih", 60);

echo "<b>Informasi Mobil 1:</b><br>";
echo $mobil1->getInfo();
$mobil1->jalankan();
$mobil1->berhenti();

echo "<b>Informasi Mobil 2:</b><br>";
echo $mobil2->getInfo();
$mobil2->jalankan();
$mobil2->berhenti();

echo "<b>Informasi Mobil 3:</b><br>";
echo $mobil3->getInfo();
$mobil3->jalankan();
$mobil3->berhenti();
?>