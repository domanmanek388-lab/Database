<?php
require_once 'config/koneksi.php';
require_once 'controllers/BukuController.php';

$db = (new Koneksi())->connect();
$controller = new BukuController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);
    header('Location: index.php?page=buku');
    exit;
}
?>

<h2>Tambah Buku</h2>
<form method="POST">
    <label>ID Buku:</label><br>
    <input type="number" name="id_buku" required><br><br>

    <label>Judul:</label><br>
    <input type="text" name="judul" required><br><br>
    <label>Penulis:</label><br>
    <input type="text" name="penulis" required><br><br>
    <label>Tahun Terbit:</label><br>
    <input type="number" name="tahun_terbit" required><br><br>
    <button type="submit">Simpan</button>
</form>
