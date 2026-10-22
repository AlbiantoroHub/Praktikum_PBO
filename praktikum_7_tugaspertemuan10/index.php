<?php

require_once 'Product.php';

$pesan = "";
$edit_mode = false;
$product_edit = null;

// 1. Proses Hapus Data (Delete)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    if (Product::delete($_GET['id'])) {
        $pesan = "Data laptop berhasil dihapus dari sistem!";
    }
}

// 2. Proses Edit Data (Menyiapkan form)
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $edit_mode = true;
    $product_edit = Product::findById($_GET['id']);
}

// 3. Proses Simpan Data (Tambah / Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $product = new Product();
    $product->setNamaProduk($nama)->setHarga($harga)->setStok($stok);

    if (isset($_POST['id_produk']) && !empty($_POST['id_produk'])) {
        if ($product->update($_POST['id_produk'])) {
            $pesan = "Spesifikasi/Harga laptop berhasil diperbarui!";
            $edit_mode = false; 
        }
    } else {
        if ($product->save()) {
            $pesan = "Model laptop baru berhasil ditambahkan ke etalase!";
        }
    }
}

// 4. Ambil Semua Data (Read All)
$products = Product::findAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Stok - Toko Laptop</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 30px; background-color: #f0f2f5; color: #333;}
        .header { margin-bottom: 20px; border-bottom: 2px solid #0056b3; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #0056b3; }
        .header p { margin: 5px 0 0 0; color: #666; font-size: 14px; }
        
        table { border-collapse: collapse; width: 100%; margin-top: 20px; background-color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #0056b3; color: white; }
        tr:hover { background-color: #f8f9fa; }
        
        .form-container { background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 400px; margin-bottom: 20px;}
        .form-container h3 { margin-top: 0; color: #333; border-bottom: 1px solid #eee; padding-bottom: 10px;}
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;}
        .form-group input { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        
        .btn { padding: 10px 15px; background-color: #0056b3; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; display: inline-block;}
        .btn:hover { background-color: #004494; }
        .btn-danger { background-color: #dc3545; }
        .btn-danger:hover { background-color: #c82333; }
        .btn-warning { background-color: #ffc107; color: #333; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-secondary { background-color: #6c757d; }
        .btn-secondary:hover { background-color: #5a6268; }
        
        .alert { padding: 12px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 20px; font-weight: bold;}

        .modal-overlay {
            display: none; 
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.6); 
            z-index: 1000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(2px);
        }
        .modal-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 400px;
            animation: fadeIn 0.3s ease-in-out;
        }
        .modal-box h3 { margin-top: 0; color: #dc3545; }
        .modal-box p { color: #555; margin-bottom: 25px; line-height: 1.5; }
        .modal-buttons { display: flex; justify-content: space-between; gap: 10px; }
        .modal-buttons .btn { flex: 1; text-align: center; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Sistem Manajemen Stok Toko Laptop</h2>
        <p>Gunakan panel ini untuk menambah, mengedit, atau menghapus data inventaris laptop.</p>
    </div>

    <?php if ($pesan != ""): ?>
        <div class="alert"><?= $pesan ?></div>
    <?php endif; ?>

    <!-- Form Tambah / Edit Laptop -->
    <div class="form-container">
        <h3><?= $edit_mode ? 'Edit Data Laptop' : 'Penerimaan Laptop Baru' ?></h3>
        
        <form action="index.php" method="POST">
            <input type="hidden" name="id_produk" value="<?= $edit_mode ? $product_edit['id'] : '' ?>">
            
            <div class="form-group">
                <label>Merek & Spesifikasi (Prosesor/RAM/VGA):</label>
                <input type="text" name="nama_produk" placeholder="Cth: Lenovo Legion 5 (Ryzen 7, RTX 3060)" required value="<?= $edit_mode ? htmlspecialchars($product_edit['nama_produk'] ?? '') : '' ?>">
            </div>
            
            <div class="form-group">
                <label>Harga Jual (Rp):</label>
                <input type="number" name="harga" placeholder="Cth: 18500000" required value="<?= $edit_mode ? $product_edit['harga'] : '' ?>">
            </div>
            
            <div class="form-group">
                <label>Stok Tersedia (Unit):</label>
                <input type="number" name="stok" placeholder="Cth: 15" required value="<?= $edit_mode ? $product_edit['stok'] : '' ?>">
            </div>
            
            <button type="submit" class="btn"><?= $edit_mode ? 'Update Inventaris' : 'Simpan ke Database' ?></button>
            
            <?php if ($edit_mode): ?>
                <a href="index.php" style="margin-left: 10px; text-decoration: none; color: #dc3545; font-weight: bold;">Batal Edit</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Tabel Daftar Laptop -->
    <h3>Etalase & Ketersediaan Gudang</h3>
    <table>
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="45%">Model Laptop & Spesifikasi Utama</th>
                <th width="20%">Harga Retail</th>
                <th width="10%">Sisa Stok</th>
                <th width="20%">Aksi Manajemen</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><strong><?= htmlspecialchars($p['nama_produk']) ?></strong></td>
                        <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                        <td>
                            <?php 
                            if ($p['stok'] <= 3) {
                                echo "<span style='color: red; font-weight: bold;'>" . $p['stok'] . " (Hampir Habis)</span>";
                            } else {
                                echo $p['stok'] . " Unit";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $p['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="javascript:void(0);" class="btn btn-danger" onclick="bukaModalHapus('index.php?action=delete&id=<?= $p['id'] ?>')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #666;">Belum ada data laptop di gudang. Silakan input laptop baru.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div id="modalKonfirmasi" class="modal-overlay">
        <div class="modal-box">
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus model laptop ini dari database? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-buttons">
                <a href="javascript:void(0);" class="btn btn-secondary" onclick="tutupModalHapus()">Batal</a>
                <a href="#" id="linkHapus" class="btn btn-danger">Ya, Hapus Data</a>
            </div>
        </div>
    </div>

    <script>
        function bukaModalHapus(urlDelete) {
            document.getElementById('modalKonfirmasi').style.display = 'flex';
            document.getElementById('linkHapus').href = urlDelete;
        }

        function tutupModalHapus() {
            document.getElementById('modalKonfirmasi').style.display = 'none';
        }
    </script>

</body>
</html>