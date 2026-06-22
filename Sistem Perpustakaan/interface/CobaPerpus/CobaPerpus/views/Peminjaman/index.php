<?php
require_once 'config/koneksi.php';
require_once 'controllers/PeminjamanController.php';

$db = (new Koneksi())->connect();
$controller = new PeminjamanController($db);
$data = $controller->index();
?>

<h2>Data Peminjaman</h2>
<a href="index.php?page=peminjaman&aksi=tambah">+ Tambah Peminjaman</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama Anggota</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $row['id_peminjaman'] ?></td>
            <td><?= $row['nama_anggota'] ?></td>
            <td><?= $row['judul_buku'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['tanggal_kembali'] ?></td>
            <td>
                <a href="index.php?page=peminjaman&aksi=edit&id=<?= $row['id_peminjaman'] ?>">Edit</a> |
                <a href="views/peminjaman/hapus.php?id=<?= $row['id_peminjaman'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
