<?php
require_once __DIR__ . '/../config/koneksi.php';

class Peminjaman
{
    private $conn;
    private $table = 'peminjaman';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT p.*, a.nama AS nama_anggota, b.judul AS judul_buku 
                  FROM peminjaman p
                  JOIN anggota a ON p.id_anggota = a.id_anggota
                  JOIN buku b ON p.id_buku = b.id_buku";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($data)
    {
        $query = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_kembali) 
                  VALUES (:id_anggota, :id_buku, :tanggal_pinjam, :tanggal_kembali)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_anggota', $data['id_anggota']);
        $stmt->bindParam(':id_buku', $data['id_buku']);
        $stmt->bindParam(':tanggal_pinjam', $data['tanggal_pinjam']);
        $stmt->bindParam(':tanggal_kembali', $data['tanggal_kembali']);
        return $stmt->execute();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM peminjaman WHERE id_peminjaman = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $query = "UPDATE peminjaman SET 
                    id_anggota = :id_anggota, 
                    id_buku = :id_buku,
                    tanggal_pinjam = :tanggal_pinjam,
                    tanggal_kembali = :tanggal_kembali 
                  WHERE id_peminjaman = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_anggota', $data['id_anggota']);
        $stmt->bindParam(':id_buku', $data['id_buku']);
        $stmt->bindParam(':tanggal_pinjam', $data['tanggal_pinjam']);
        $stmt->bindParam(':tanggal_kembali', $data['tanggal_kembali']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM peminjaman WHERE id_peminjaman = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
