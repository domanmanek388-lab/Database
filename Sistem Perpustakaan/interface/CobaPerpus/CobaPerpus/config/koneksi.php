<?php
class Koneksi
{
    private $host = "localhost";
    private $db_name = "perpustakaan";
    private $username = "root";
    private $password = "";
    public $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Koneksi berhasil"; // bisa diaktifkan untuk debug
        } catch (PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }

        return $this->conn;
    }
}
