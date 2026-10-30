<?php

class Anggota {
    private int $idAnggota;
    private string $nama;
    private string $alamat;
    private string $noTelepon;

    public function __construct(int $idAnggota, string $nama, string $alamat, string $noTelepon) {
        $this->idAnggota = $idAnggota;
        $this->nama = $nama;
        $this->alamat = $alamat;
        $this->noTelepon = $noTelepon;
    }

    public function getDetailAnggota(): string {
        return "ID: $this->idAnggota, Nama: $this->nama, Alamat: $this->alamat, Telp: $this->noTelepon";
    }
}

class Buku {
    private int $kodeBuku;
    private string $judul;
    private string $penulis;
    private int $tahunTerbit;

    public function __construct(int $kodeBuku, string $judul, string $penulis, int $tahunTerbit) {
        $this->kodeBuku = $kodeBuku;
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahunTerbit = $tahunTerbit;
    }

    public function getDetailBuku(): string {
        return "Kode: $this->kodeBuku, Judul: $this->judul, Penulis: $this->penulis ($this->tahunTerbit)";
    }
}

class Peminjaman {
    private int $idPeminjaman;
    private int $idAnggota;
    private int $kodeBuku;
    private string $tanggalPeminjaman;
    private string $tanggalPengembalian = "-";
    private string $statusPeminjaman = "Belum Dipinjam";

    public function __construct(int $idPeminjaman, int $idAnggota, int $kodeBuku, string $tanggalPeminjaman) {
        $this->idPeminjaman = $idPeminjaman;
        $this->idAnggota = $idAnggota;
        $this->kodeBuku = $kodeBuku;
        $this->tanggalPeminjaman = $tanggalPeminjaman;
    }

    public function catatPeminjaman(): void {
        $this->perbaruiStatus("Dipinjam");
        echo "Peminjaman ID $this->idPeminjaman berhasil dicatat (Anggota: $this->idAnggota, Buku: $this->kodeBuku, Tanggal: $this->tanggalPeminjaman).<br>";
    }

    public function catatPengembalian(string $tanggalKembali): void {
        $this->tanggalPengembalian = $tanggalKembali;
        $this->perbaruiStatus("Dikembalikan");
        echo "Buku telah dikembalikan pada tanggal $this->tanggalPengembalian.<br>";
    }

    public function perbaruiStatus(string $statusBaru): void {
        $this->statusPeminjaman = $statusBaru;
        echo "Status peminjaman sekarang: <b>$this->statusPeminjaman</b><br>";
    }
}

echo "<h3>Simulasi Peminjaman Buku Perpustakaan</h3>";

$anggota = new Anggota(1, "Budi", "Jl. Merdeka No. 10", "08123456789");
$buku = new Buku(101, "Belajar PBO", "Andi", 2024);

echo "<b>Data Anggota:</b> " . $anggota->getDetailAnggota() . "<br>";
echo "<b>Data Buku:</b> " . $buku->getDetailBuku() . "<br><br>";

echo "<b>Proses Peminjaman:</b><br>";
$pinjam = new Peminjaman(1001, 1, 101, "2026-10-29");
$pinjam->catatPeminjaman();

echo "<br><b>Proses Pengembalian:</b><br>";
$pinjam->catatPengembalian("2026-11-01");

?>
