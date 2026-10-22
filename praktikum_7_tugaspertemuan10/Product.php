<?php

require_once 'DatabaseConnection.php';

class Product {
    private $id;
    private $nama_produk;
    private $harga;
    private $stok;
    private $db;

    public function __construct() {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function setNamaProduk($nama) {
        $this->nama_produk = $nama;
        return $this;
    }

    public function setHarga($harga) {
        $this->harga = $harga;
        return $this;
    }

    public function setStok($stok) {
        $this->stok = $stok;
        return $this;
    }

    // 1. Tambah Data
    public function save() {
        $sql = "INSERT INTO products (nama_produk, harga, stok) VALUES (:nama_produk, :harga, :stok)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,
            'stok' => $this->stok
        ]);
    }

    // 2. Lihat Semua Data 
    public static function findAll() {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // 3. Lihat Satu Data (Berdasarkan ID)
    public static function findById($id) {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // 4. Update Data
    public function update($id) {
        $sql = "UPDATE products SET nama_produk = :nama_produk, harga = :harga, stok = :stok WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'id' => $id
        ]);
    }

    // 5. Hapus Data
    public static function delete($id) {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>