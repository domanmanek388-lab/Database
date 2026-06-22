<?php
// Daftar halaman yang valid
$validPages = ['dashboard', 'anggota', 'kartu_anggota', 'buku', 'peminjaman'];
$page = $_GET['page'] ?? 'dashboard'; // Default to dashboard

if (!in_array($page, $validPages)) {
    $page = 'dashboard';
}

$aksi = $_GET['aksi'] ?? 'index'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin Perpustakaan</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
           
            const currentPage = "<?php echo $page; ?>";
            const sidebarLinks = document.querySelectorAll('.sidebar ul li a');
            
            sidebarLinks.forEach(link => {
                const linkPage = new URL(link.href).searchParams.get('page');
                if (linkPage === currentPage) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2><i class="fas fa-book-open"></i> Perpustakaan</h2>
            <ul>
                <li><a href="index.php?page=dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="index.php?page=anggota"><i class="fas fa-users"></i> Anggota</a></li>
                <li><a href="index.php?page=kartu_anggota"><i class="fas fa-id-card"></i> Kartu Anggota</a></li>
                <li><a href="index.php?page=buku"><i class="fas fa-book"></i> Buku</a></li>
                <li><a href="index.php?page=peminjaman"><i class="fas fa-handshake"></i> Peminjaman</a></li>
            </ul>
        </aside>

        <main class="content">
            <?php
            $path = "views/{$page}/{$aksi}.php";
            
            // Jika file tidak ditemukan, tampilkan pesan error atau redirect
            if (file_exists($path)) {
                include $path;  
            } else if ($page === 'dashboard') {
                // Jika halaman dashboard tidak ditemukan, tampilkan default
                echo "<h1>Selamat Datang di Dashboard</h1>";
                echo "<p>Ringkasan data perpustakaan akan ditampilkan di sini.</p>";
            } else {
                // Jika halaman lain tidak ditemukan, redirect ke dashboard
                header("Location: index.php?page=dashboard");
                exit();
            }
            ?>
        </main>
    </div>
</body>
</html>
