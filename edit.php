<?php
include 'config/koneksi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM barang WHERE idbarang = ?");
$stmt->execute([$id]);
$barang = $stmt->fetch(PDO::FETCH_ASSOC);

$stmtSatuan = $pdo->query("SELECT * FROM v_satuan WHERE status = 1");
$satuanList = $stmtSatuan->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis = $_POST['jenis'];
    $nama = $_POST['nama'];
    $idsatuan = $_POST['idsatuan'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];

    // Raw SQL UPDATE murni
    $sql = "UPDATE barang SET jenis = ?, nama = ?, idsatuan = ?, status = ?, harga = ? WHERE idbarang = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$jenis, $nama, $idsatuan, $status, $harga, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="container mt-4">
    <h2>Form Edit Barang</h2>
    <form action="" method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Jenis Barang (B/K)</label>
            <input type="text" name="jenis" class="form-control" value="<?= $barang['jenis']; ?>" maxlength="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama" class="form-control" value="<?= $barang['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <select name="idsatuan" class="form-control" required>
                <?php foreach ($satuanList as $s): ?>
                    <option value="<?= $s['idsatuan']; ?>" <?= $s['idsatuan'] == $barang['idsatuan'] ? 'selected' : ''; ?>>
                        <?= $s['nama_satuan']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $barang['harga']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="1" <?= $barang['status'] == 1 ? 'selected' : ''; ?>>Aktif</option>
                <option value="0" <?= $barang['status'] == 0 ? 'selected' : ''; ?>>Non-Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
    <script src="assets/js/script.js"></script>
</body>

</html>