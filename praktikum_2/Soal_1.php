<?php

function hitungNilaiAkhir($uts, $uas, $tugas) {
    $rataRata = ($uts + $uas + $tugas) / 3;
    return $rataRata;
}

$hasil = hitungNilaiAkhir(80, 85, 90);

echo "Nilai Akhir: " . $hasil;

?>