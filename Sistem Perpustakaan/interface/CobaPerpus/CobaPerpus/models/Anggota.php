<?php
require_once __DIR__ . '/../config/koneksi.php';

class Anggota
{
    private $conn;
    private $table = 'anggota';

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
    $query = "INSERT INTO anggota (id_anggota, nama, email) VALUES (:id_anggota, :nama, :email)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id_anggota', $data['id_anggota']);
    $stmt->bindParam(':nama', $data['nama']);
    $stmt->bindParam(':email', $data['email']);
    return $stmt->execute();
}

public function getById($id)
{
    $query = "SELECT * FROM anggota WHERE id_anggota = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function update($id, $data)
{
    $query = "UPDATE anggota SET nama = :nama, email = :email WHERE id_anggota = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nama', $data['nama']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

public function delete($id)
{
    $query = "DELETE FROM anggota WHERE id_anggota = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

}
