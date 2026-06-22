    <?php
    // Anda bisa menambahkan logika untuk mengambil ringkasan data di sini
    // Misalnya, jumlah anggota, jumlah buku, jumlah peminjaman aktif, dll.
    require_once 'config/koneksi.php';
    require_once 'controllers/AnggotaController.php';
    require_once 'controllers/BukuController.php';
    require_once 'controllers/PeminjamanController.php';

    $db = (new Koneksi())->connect();

    $anggotaController = new AnggotaController($db);
    $bukuController = new BukuController($db);
    $peminjamanController = new PeminjamanController($db);

    $totalAnggota = $anggotaController->index()->rowCount();
    $totalBuku = $bukuController->index()->rowCount();
    $totalPeminjaman = $peminjamanController->index()->rowCount();
    // Anda bisa menambahkan query untuk peminjaman aktif, buku tersedia, dll.
    ?>

    <h1>Selamat Datang di Dashboard Perpustakaan</h1>

    <p>Ini adalah ringkasan cepat dari sistem perpustakaan.</p>

    <div style="display: flex; gap: 20px; margin-top: 30px;">
        <div style="background-color: #e0f7fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex: 1;">
            <h3>Total Anggota</h3>
            <p style="font-size: 2em; font-weight: bold; color: #007bff;"><?= $totalAnggota ?></p>
            <a href="index.php?page=anggota" style="color: #007bff; text-decoration: none;">Lihat Detail <i class="fas fa-arrow-right"></i></a>
        </div>
        <div style="background-color: #e8f5e9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex: 1;">
            <h3>Total Buku</h3>
            <p style="font-size: 2em; font-weight: bold; color: #28a745;"><?= $totalBuku ?></p>
            <a href="index.php?page=buku" style="color: #28a745; text-decoration: none;">Lihat Detail <i class="fas fa-arrow-right"></i></a>
        </div>
        
        <div style="background-color: #fff3e0; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex: 1;">
            <h3>Total Peminjaman</h3>
            <p style="font-size: 2em; font-weight: bold; color: #ffc107;"><?= $totalPeminjaman ?></p>
            <a href="index.php?page=peminjaman" style="color: #ffc107; text-decoration: none;">Lihat Detail <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>

    <!-- Anda bisa menambahkan grafik, statistik lain, atau berita terbaru di sini -->
    