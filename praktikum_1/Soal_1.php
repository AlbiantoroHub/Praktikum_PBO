<?php

function hitungNilaiAkhir($uts, $uas, $tugas): float {
    $nilaiAkhir = ($uts * 0.30) + ($uas * 0.40) + ($tugas * 0.30);
    return (float) $nilaiAkhir;
}

// Data nilai uji coba
$uts   = 80;
$uas   = 85;
$tugas = 90;

// Memanggil fungsi
$nilaiAkhir = hitungNilaiAkhir($uts, $uas, $tugas);

// Menampilkan output
echo "Nilai UTS: $uts <br>";
echo "Nilai UAS: $uas <br>";
echo "Nilai Tugas: $tugas <br>";
echo "Nilai Akhir: $nilaiAkhir";
?>