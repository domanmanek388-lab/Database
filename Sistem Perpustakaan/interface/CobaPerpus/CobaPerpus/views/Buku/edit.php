<?php
require_once 'config/koneksi.php';
require_once 'controllers/BukuController.php';

$db = (new Koneksi())->connect();
$controller = new BukuController($db);

$id = $_GET['id'];
$buku = $controller->show($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST);
    header('Location: index.php?page=buku');
    exit;
}
?>

<h2>Edit Buku</h2>
<form method="POST">
    <label>Judul:</label><br>
    <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" required><br><br>
    <label>Penulis:</label><br>
    <input type="text" name="penulis" value="<?= htmlspecialchars($buku['penulis']) ?>" required><br><br>
    <label>Tahun Terbit:</label><br>
    <input type="number" name="tahun_terbit" value="<?= htmlspecialchars($buku['tahun_terbit']) ?>" required><br><br>
    <button type="submit">Update</button>
</form>
