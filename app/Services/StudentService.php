<?php

namespace App\Services;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function getStudents($search)
    {
        return Student::query()
            ->when($search, function ($query, $search) {
                $query->where('firstname', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('passport_number', 'like', "%{$search}%")
                      ->orWhere('nationality', 'like', "%{$search}%");
            })
            ->orderBy('firstname', 'DESC')
            ->paginate(10);
    }

    public function getStudentById($id)
    {
        return Student::findOrFail($id);
    }

    public function storeStudent(StoreStudentRequest $request)
    {
        $data = $request->validated();
        $student = $this->studentRepository->create($data);

        if ($request->hasFile('fircopy')) {
            $student->clearMediaCollection('fircopy');
            $student->addMedia($request->file('fircopy'))
                    ->preservingOriginal()
                    ->toMediaCollection('fircopy');
        }

        return $student;
    }

    public function updateStudent(UpdateStudentRequest $request, Student $student)
    {
        $validatedData = $request->validated();
        $this->studentRepository->update($student, $validatedData);

        if ($request->hasFile('fircopy')) {
            $student->clearMediaCollection('fircopy');
            $student->addMedia($request->file('fircopy'))
                    ->preservingOriginal()
                    ->toMediaCollection('fircopy');
        }

        return $student;
    }

    public function deleteStudent(Student $student)
    {
        $student->clearMediaCollection('fircopy');
        $student->delete();
    }
}