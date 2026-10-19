<?php
include 'config/koneksi.php';

$stmtSatuan = $pdo->query("SELECT * FROM v_satuan WHERE status = 1");
$satuanList = $stmtSatuan->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis = $_POST['jenis'];
    $nama = $_POST['nama'];
    $idsatuan = $_POST['idsatuan'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];

    $sql = "INSERT INTO barang (jenis, nama, idsatuan, status, harga) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$jenis, $nama, $idsatuan, $status, $harga]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="container mt-4">
    <h2>Form Tambah Barang</h2>
    <form action="" method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Jenis Barang (B/K)</label>
            <input type="text" name="jenis" class="form-control" maxlength="1" required placeholder="B atau K">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <select name="idsatuan" class="form-control" required>
                <option value="">-- Pilih Satuan --</option>
                <?php foreach ($satuanList as $s): ?>
                    <option value="<?= $s['idsatuan']; ?>"><?= $s['nama_satuan']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="1">Aktif</option>
                <option value="0">Non-Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
    <script src="assets/js/script.js"></script>
</body>

</html>