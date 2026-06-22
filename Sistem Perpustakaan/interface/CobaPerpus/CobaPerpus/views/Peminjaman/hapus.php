<?php
require_once '../../config/koneksi.php';
require_once '../../controllers/PeminjamanController.php';

$db = (new Koneksi())->connect();
$controller = new PeminjamanController($db);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $controller->delete($_GET['id']);
}

header('Location: ../../index.php?page=peminjaman');
exit;
