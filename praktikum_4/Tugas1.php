<?php

class Produk {
    protected $nama;
    protected $merek;
    protected $harga;

    public function __construct($nama, $merek, $harga) {
        $this->nama = $nama;
        $this->merek = $merek;
        
        if ($harga <= 0) {
            throw new Exception("Harga produk harus lebih dari Rp 0.");
        }
        $this->harga = $harga;
    }

    public function getInfo() {
        return "Merek: " . $this->merek . "<br>" .
               "Harga: Rp " . number_format($this->harga, 0, ',', '.');
    }
}

class Makanan extends Produk {
    private $tanggalKadaluarsa;

    public function __construct($nama, $merek, $harga, $tanggalKadaluarsa) {
        parent::__construct($nama, $merek, $harga);
        $this->tanggalKadaluarsa = $tanggalKadaluarsa;
    }

    private function cekStatus() {
        $hariIni = date('Y-m-d');
        if ($this->tanggalKadaluarsa < $hariIni) {
            return "Kedaluwarsa";
        } else {
            return "Segar";
        }
    }

    public function getInfo() {
        return "Produk: Makanan - " . $this->nama . "<br>" .
               parent::getInfo() . "<br>" .
               "Tanggal Kedaluwarsa: " . $this->tanggalKadaluarsa . "<br>" .
               "Status: " . $this->cekStatus() . "<br>";
    }
}
class Elektronik extends Produk {
    private $garansi; 

    public function __construct($nama, $merek, $harga, $garansi) {
        parent::__construct($nama, $merek, $harga);
        $this->garansi = $garansi;
    }

    public function getInfo() {
        return "Produk: Elektronik - " . $this->nama . "<br>" .
               parent::getInfo() . "<br>" .
               "Garansi: " . $this->garansi . " bulan<br>";
    }
}

try {
    $mie = new Makanan("Mie Instan", "Indomie", 3500, "2027-06-30");
    echo $mie->getInfo();
    echo "<br>";

    $tv = new Elektronik("Smart TV", "Samsung", 5000000, 12);
    echo $tv->getInfo();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>