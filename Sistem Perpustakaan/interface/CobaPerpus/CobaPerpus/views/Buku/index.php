<?php
require_once 'config/koneksi.php';
require_once 'controllers/BukuController.php';

$db = (new Koneksi())->connect();
$controller = new BukuController($db);
$data = $controller->index();
?>

<h2>Data Buku</h2>

<!-- Link Navigasi -->
<li><a href="index.php?page=buku">Buku</a></li>
<a href="index.php?page=buku&aksi=tambah">+ Tambah Buku</a>

<!-- Tampilkan Error Jika Ada -->
<?php if (isset($_GET['error'])): ?>
    <div style="color: red; font-weight: bold; margin-top: 10px;">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<!-- Tabel Buku -->
<table border="1" cellpadding="10" style="margin-top: 10px;">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tahun</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $row['id_buku'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['penulis'] ?></td>
            <td><?= $row['tahun_terbit'] ?></td>
            <td>
                <a href="index.php?page=buku&aksi=edit&id=<?= $row['id_buku'] ?>">Edit</a> |
                <a href="views/buku/hapus.php?id=<?= $row['id_buku'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
