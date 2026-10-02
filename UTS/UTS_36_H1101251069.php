<?php

abstract class LesMusik {
    protected $id;
    protected $nama;
    protected $hargaDasar; 

    public function __construct($id, $nama, $hargaDasar) {
        $this->id = $id;
        $this->nama = $nama;
        $this->hargaDasar = $hargaDasar; 
    }

    public function getId() {return $this->id; }
    public function getNama() {return $this->nama; }
    public function getHargaDasar() {return $this->hargaDasar; }

    abstract public function hitungTotal();
    abstract public function getJenis();
}

class Gitar extends LesMusik {
    private $sesi;

    public function __construct($id, $nama, $hargaDasar, $sesi){
        parent::__construct($id, $nama, $hargaDasar);
        $this->sesi = $sesi;
    }

    public function hitungTotal() {
        return ($this->hargaDasar * $this->sesi) + 20000 ;
    }

    public function getJenis() {
        return "Gitar";
    }

    public function cekDetail() {
        return "Gitar ({$this->sesi} sesi, termasuk senar)";
    }
}

class Piano extends LesMusik {
    private $sesi;

    public function __construct($id, $nama, $hargaDasar, $sesi){
        parent::__construct($id, $nama, $hargaDasar);
        $this->sesi = $sesi;
    }

    public function hitungTotal() {
        $total = $this->hargaDasar * $this->sesi;
        if ($this->sesi > 5) {
            $total = $total - ($total * 0.1);
        }
        return $total;
    }

    public function getJenis() {
        return "Piano";
    }

    public function cekDetail() {
        return "Piano ({$this->sesi} sesi, termasuk diskon *jika sesi > 5)";
    }
}

class Drum extends LesMusik {
    private $sesi;

    public function __construct($id, $nama, $hargaDasar, $sesi){
        parent::__construct($id, $nama, $hargaDasar);
        $this->sesi = $sesi;
    }

    public function hitungTotal() {
        return ($this->hargaDasar * $this->sesi) + 30000;
    }

    public function getJenis() {
        return "Drum";
    }

    public function cekDetail() {
        return "Drum ({$this->sesi} sesi, termasuk stik)";
    }
}

$murid1 = new Gitar ("LM001", "Chattama Albiantoro", 100000, 4);
$murid2 = new Piano ("LM002", "Maulana Malik Ibrahim", 150000, 6);
$murid3 = new Drum ("LM003", "Phasacola Grey Kalista", 120000, 3);
$murid4 = new Gitar ("LM004", "Budi Santoso", 150000 , 5);
$murid5 = new Piano ("LM005", "Udin Bayu Sapudin", 100000 , 2);

echo $murid1->getNama() . " | " . $murid1->getJenis() . " | " . $murid1->cekDetail() . " | Total: Rp " . $murid1->hitungTotal() . "<br>";
echo $murid2->getNama() . " | " . $murid2->getJenis() . " | " . $murid2->cekDetail() . " | Total: Rp " . $murid2->hitungTotal() . "<br>";
echo $murid3->getNama() . " | " . $murid3->getJenis() . " | " . $murid3->cekDetail() . " | Total: Rp " . $murid3->hitungTotal() . "<br>";
echo $murid4->getNama() . " | " . $murid4->getJenis() . " | " . $murid4->cekDetail() . " | Total: Rp " . $murid4->hitungTotal() . "<br>";
echo $murid5->getNama() . " | " . $murid5->getJenis() . " | " . $murid5->cekDetail() . " | Total: Rp " . $murid5->hitungTotal() . "<br>";

$totalKeseluruhan = $murid1->hitungTotal() + $murid2->hitungTotal() + $murid3->hitungTotal() + $murid4->hitungTotal() + $murid5->hitungTotal();

echo "<br>Total Pendapatan Les Musik Keseluruhan: Rp " . $totalKeseluruhan;
?>