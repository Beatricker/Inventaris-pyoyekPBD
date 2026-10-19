<?php
include 'config/koneksi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM barang WHERE idbarang = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
