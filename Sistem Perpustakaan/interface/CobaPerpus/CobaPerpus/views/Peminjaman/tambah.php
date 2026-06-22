<?php
require_once 'config/koneksi.php';
require_once 'controllers/PeminjamanController.php';
require_once 'models/Anggota.php';
require_once 'models/Buku.php';

$db = (new Koneksi())->connect();
$controller = new PeminjamanController($db);
$anggotaModel = new Anggota($db);
$bukuModel = new Buku($db);

$anggotaList = $anggotaModel->getAll();
$bukuList = $bukuModel->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);
    header('Location: index.php?page=peminjaman');
    exit;
}
?>

<h2>Tambah Peminjaman</h2>
<form method="POST">
    <label>Anggota:</label><br>
    <select name="id_anggota" required>
        <option value="">-- Pilih Anggota --</option>
        <?php while ($a = $anggotaList->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?= $a['id_anggota'] ?>"><?= $a['nama'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Buku:</label><br>
    <select name="id_buku" required>
        <option value="">-- Pilih Buku --</option>
        <?php while ($b = $bukuList->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?= $b['id_buku'] ?>"><?= $b['judul'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Tanggal Pinjam:</label><br>
    <input type="date" name="tanggal_pinjam" required><br><br>

    <label>Tanggal Kembali:</label><br>
    <input type="date" name="tanggal_kembali" required><br><br>

    <button type="submit">Simpan</button>
</form>
