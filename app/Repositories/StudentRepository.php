<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function create(array $data)
    {
        return Student::create($data);
    }

    public function update(Student $student, array $data)
    {
        $student->update($data);
        return $student;
    }
}

?>