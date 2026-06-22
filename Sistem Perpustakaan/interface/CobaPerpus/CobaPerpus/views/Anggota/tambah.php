<?php
require_once 'config/koneksi.php';
require_once 'controllers/AnggotaController.php';

$db = (new Koneksi())->connect();
$controller = new AnggotaController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);
    header('Location: index.php?page=anggota');
    exit;
}
?>

<h2>Tambah Anggota</h2>
<form method="POST">
    <label>ID Anggota:</label><br>
    <input type="number" name="id_anggota" required><br><br>
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    <button type="submit">Simpan</button>
</form>
