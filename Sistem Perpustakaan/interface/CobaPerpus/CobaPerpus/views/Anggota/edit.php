<?php
require_once 'config/koneksi.php';
require_once 'controllers/AnggotaController.php';

$db = (new Koneksi())->connect();
$controller = new AnggotaController($db);
$id = $_GET['id'];
$anggota = $controller->show($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST);
    header('Location: index.php?page=anggota');
    exit;
}
?>

<h2>Edit Anggota</h2>
<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $anggota['nama'] ?>" required><br><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $anggota['email'] ?>" required><br><br>
    <button type="submit">Update</button>
</form>
