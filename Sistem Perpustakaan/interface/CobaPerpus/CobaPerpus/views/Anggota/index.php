<?php
require_once 'config/koneksi.php';
require_once 'controllers/AnggotaController.php';

$db = (new Koneksi())->connect();
$controller = new AnggotaController($db);
$dataAnggota = $controller->index();
?>

<h2>Data Anggota</h2>
<a href="index.php?page=anggota&aksi=tambah">Tambah Anggota</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $dataAnggota->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $row['id_anggota'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="?page=anggota&aksi=edit&id=<?= $row['id_anggota'] ?>">Edit</a> |
                <a href="views/anggota/hapus.php?id=<?= $row['id_anggota'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
