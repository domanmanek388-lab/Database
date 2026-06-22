<?php
require_once __DIR__ . '/../config/koneksi.php';

class Buku
{
    private $conn;
    private $table = 'buku';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($data)
    {
        $query = "INSERT INTO buku (judul, penulis, tahun_terbit) VALUES (:judul, :penulis, :tahun)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':judul', $data['judul']);
        $stmt->bindParam(':penulis', $data['penulis']);
        $stmt->bindParam(':tahun', $data['tahun_terbit']);
        return $stmt->execute();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM buku WHERE id_buku = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $query = "UPDATE buku SET judul = :judul, penulis = :penulis, tahun_terbit = :tahun WHERE id_buku = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':judul', $data['judul']);
        $stmt->bindParam(':penulis', $data['penulis']);
        $stmt->bindParam(':tahun', $data['tahun_terbit']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id_buku)
    {
        // Cek apakah buku sedang dipinjam
        $queryCheck = "SELECT COUNT(*) FROM peminjaman WHERE id_buku = :id";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(':id', $id_buku);
        $stmtCheck->execute();
        $count = $stmtCheck->fetchColumn();

        if ($count > 0) {
            throw new Exception("Buku tidak dapat dihapus karena sedang dipinjam.");
        }

        $query = "DELETE FROM " . $this->table . " WHERE id_buku = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id_buku);
        return $stmt->execute();
    }
}
