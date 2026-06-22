<?php
require_once '../../config/koneksi.php';
require_once '../../controllers/BukuController.php';

$db = (new Koneksi())->connect();
$controller = new BukuController($db);

if (isset($_GET['id'])) {
    $controller->delete($_GET['id']);
}

header('Location: ../../index.php?page=buku');
exit;
