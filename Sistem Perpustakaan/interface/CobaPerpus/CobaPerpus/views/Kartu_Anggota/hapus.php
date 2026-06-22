<?php
require_once '../../config/koneksi.php';
require_once '../../controllers/KartuAnggotaController.php';

$db = (new Koneksi())->connect();
$controller = new KartuAnggotaController($db);

if (isset($_GET['id'])) {
    $controller->delete($_GET['id']);
}

header('Location: ../../index.php?page=kartu_anggota');
exit;
