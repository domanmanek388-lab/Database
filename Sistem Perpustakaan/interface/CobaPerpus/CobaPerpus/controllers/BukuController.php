<?php
require_once __DIR__ . '/../models/Buku.php';

class BukuController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Buku($db);
    }

    public function index()
    {
        return $this->model->getAll();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->getById($id);
    }

    public function update($id, $data)
    {
        return $this->model->update($id, $data);
    }

    public function delete($id)
    {
        try {
        $this->model->delete($id);
        header("Location: ../index.php?page=buku");
    } catch (Exception $e) {
        // Kirim pesan error ke halaman
        $message = urlencode($e->getMessage());
        header("Location: ../index.php?page=buku&error=$message");
    }
    }
    
}
