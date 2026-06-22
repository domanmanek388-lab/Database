<?php
require_once 'config/koneksi.php';
require_once 'controllers/PeminjamanController.php';
require_once 'models/Anggota.php';
require_once 'models/Buku.php';

$db = (new Koneksi())->connect();
$controller = new PeminjamanController($db);
$anggotaModel = new Anggota($db);
$bukuModel = new Buku($db);

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header('Location: index.php?page=peminjaman');
    exit;
}

$data = $controller->show($id);
$anggotaList = $anggotaModel->getAll();
$bukuList = $bukuModel->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST);
    header('Location: index.php?page=peminjaman');
    exit;
}
?>

<h2>Edit Data Peminjaman</h2>
<form method="POST">
    <label>Anggota:</label><br>
    <select name="id_anggota" required>
        <?php while ($a = $anggotaList->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?= $a['id_anggota'] ?>" <?= $a['id_anggota'] == $data['id_anggota'] ? 'selected' : '' ?>>
                <?= $a['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Buku:</label><br>
    <select name="id_buku" required>
        <?php while ($b = $bukuList->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?= $b['id_buku'] ?>" <?= $b['id_buku'] == $data['id_buku'] ? 'selected' : '' ?>>
                <?= $b['judul'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Tanggal Pinjam:</label><br>
    <input type="date" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam'] ?>" required><br><br>

    <label>Tanggal Kembali:</label><br>
    <input type="date" name="tanggal_kembali" value="<?= $data['tanggal_kembali'] ?>" required><br><br>

    <button type="submit">Update</button>
</form>
