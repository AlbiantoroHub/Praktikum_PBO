<?php
class Mobil {
    private $merek;
    private $warna;
    private $kecepatan;

    public function __construct($merek, $warna, $kecepatan = 0) {
        $this->merek = $merek;
        $this->setWarna($warna);
        $this->setKecepatan($kecepatan);
    }

    public function getMerek() {
        return $this->merek;
    }

    public function getWarna() {
        return $this->warna;
    }

    public function getKecepatan() {
        return $this->kecepatan;
    }

    public function setKecepatan($kecepatan) {
        if ($kecepatan < 0) {
            throw new Exception("Kecepatan tidak boleh negatif!");
        }
        if ($kecepatan > 200) {
            throw new Exception("Kecepatan maksimal 200 km/jam!");
        }
        $this->kecepatan = $kecepatan;
    }

    public function setWarna($warna) {
        if (empty($warna)) {
            throw new Exception("Warna tidak boleh kosong!");
        }
        if (strlen($warna) < 3) {
            throw new Exception("Warna minimal 3 karakter!");
        }
        $this->warna = $warna;
    }
}

try {
    $mobil1 = new Mobil("Toyota", "Hitam", 100);
    echo "Merek: " . $mobil1->getMerek() . "<br>";
    echo "Warna: " . $mobil1->getWarna() . "<br>";
    echo "Kecepatan: " . $mobil1->getKecepatan() . " km/jam<br><br>";

} catch (Exception $e) {
    echo "Gagal: " . $e->getMessage() . "<br>";
}
?>