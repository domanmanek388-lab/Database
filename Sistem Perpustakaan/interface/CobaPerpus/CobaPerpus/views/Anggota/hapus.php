<?php
require_once '../../config/koneksi.php';
require_once '../../controllers/AnggotaController.php';

$db = (new Koneksi())->connect();
$controller = new AnggotaController($db);

if (isset($_GET['id'])) {
    $controller->delete($_GET['id']);
}

header('Location: ../../index.php?page=anggota');

exit;
