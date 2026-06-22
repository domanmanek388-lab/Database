<?php
require_once __DIR__ . '/../models/KartuAnggota.php';

class KartuAnggotaController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new KartuAnggota($db);
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
        return $this->model->delete($id);
    }
}
