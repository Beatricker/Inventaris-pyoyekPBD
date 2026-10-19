<?php
include 'config/koneksi.php';

$stmt = $pdo->query("SELECT * FROM v_barang");
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Master Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="container mt-4">
    <h2>Daftar Barang</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Barang Baru</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang as $b): ?>
                <tr>
                    <td><?= $b['idbarang']; ?></td>
                    <td><?= $b['jenis']; ?></td>
                    <td><?= $b['nama_barang']; ?></td>
                    <td><?= $b['nama_satuan']; ?></td>
                    <td>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
                    <td><?= $b['status'] == 1 ? 'Aktif' : 'Non-Aktif'; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $b['idbarang']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="hapus.php?id=<?= $b['idbarang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="assets/js/script.js"></script>
</body>

</html>