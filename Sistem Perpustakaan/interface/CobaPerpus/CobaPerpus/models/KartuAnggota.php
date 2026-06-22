<?php
require_once __DIR__ . '/../config/koneksi.php';

class KartuAnggota
{
    private $conn;
    private $table = 'kartu_anggota';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT ka.*, a.nama 
                  FROM " . $this->table . " ka
                  JOIN anggota a ON ka.id_anggota = a.id_anggota";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($data)
    {
        $query = "INSERT INTO kartu_anggota (id_anggota, tanggal_terbit, tanggal_kadaluarsa) 
                  VALUES (:id_anggota, :terbit, :kadaluarsa)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_anggota', $data['id_anggota']);
        $stmt->bindParam(':terbit', $data['tanggal_terbit']);
        $stmt->bindParam(':kadaluarsa', $data['tanggal_kadaluarsa']);
        return $stmt->execute();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_kartu = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $query = "UPDATE kartu_anggota 
                  SET id_anggota = :id_anggota, 
                      tanggal_terbit = :terbit, 
                      tanggal_kadaluarsa = :kadaluarsa 
                  WHERE id_kartu = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_anggota', $data['id_anggota']);
        $stmt->bindParam(':terbit', $data['tanggal_terbit']);
        $stmt->bindParam(':kadaluarsa', $data['tanggal_kadaluarsa']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM kartu_anggota WHERE id_kartu = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
