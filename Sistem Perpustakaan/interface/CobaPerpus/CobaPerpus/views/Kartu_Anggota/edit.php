<?php
require_once 'config/koneksi.php';
require_once 'controllers/KartuAnggotaController.php';
require_once 'models/Anggota.php';

$db = (new Koneksi())->connect();
$controller = new KartuAnggotaController($db);
$anggotaModel = new Anggota($db);
$listAnggota = $anggotaModel->getAll();

$id = $_GET['id'];
$data = $controller->show($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST);
    header('Location: index.php?page=kartu_anggota');
    exit;
}
?>

<h2>Edit Kartu Anggota</h2>
<form method="POST">
    <label>Anggota:</label><br>
    <select name="id_anggota" required>
        <?php while ($a = $listAnggota->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?= $a['id_anggota'] ?>" <?= $a['id_anggota'] == $data['id_anggota'] ? 'selected' : '' ?>>
                <?= $a['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Tanggal Terbit:</label><br>
    <input type="date" name="tanggal_terbit" value="<?= $data['tanggal_terbit'] ?>" required><br><br>

    <label>Tanggal Kadaluarsa:</label><br>
    <input type="date" name="tanggal_kadaluarsa" value="<?= $data['tanggal_kadaluarsa'] ?>" required><br><br>

    <button type="submit">Update</button>
</form>
