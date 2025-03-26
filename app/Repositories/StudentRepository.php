<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    protected $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id); 
        return $record->update($data); 
    }
    

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}