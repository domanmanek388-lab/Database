<?php
require_once 'config/koneksi.php';
require_once 'controllers/KartuAnggotaController.php';

$db = (new Koneksi())->connect();
$controller = new KartuAnggotaController($db);
$data = $controller->index();
?>

<h2>Data Kartu Anggota</h2>
<a href="index.php?page=kartu_anggota&aksi=tambah">+ Tambah Kartu</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID Kartu</th>
        <th>Nama Anggota</th>
        <th>Tanggal Terbit</th>
        <th>Tanggal Kadaluarsa</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $row['id_kartu'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['tanggal_terbit'] ?></td>
            <td><?= $row['tanggal_kadaluarsa'] ?></td>
            <td>
                <a href="index.php?page=kartu_anggota&aksi=edit&id=<?= $row['id_kartu'] ?>">Edit</a> |
                <a href="views/kartu_anggota/hapus.php?id=<?= $row['id_kartu'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
