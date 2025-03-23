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
        if ($request->hasFile('fircopy')) {
            $data['fircopy'] = $this->handleFileUpload($request, 'fircopy', 'uploads/passport');
        }
        return $this->studentRepository->create($data);
    }

    public function updateStudent(UpdateStudentRequest $request, Student $student)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('fircopy')) {
            $this->deleteOldFile($student->fircopy);
            $validatedData['fircopy'] = $this->handleFileUpload($request, 'fircopy', 'uploads/passport');
        }
        return $this->studentRepository->update($student, $validatedData);
    }

    public function deleteStudent(Student $student)
    {
        $this->deleteOldFile($student->fircopy);
        Storage::disk('public')->deleteDirectory('uploads/passport');
        $student->delete();
    }

    private function handleFileUpload($request, $fieldName, $directory)
    {
        if ($request->hasFile($fieldName) && $request->file($fieldName)->isValid()) {
            $filename = time() . '-' . $request->file($fieldName)->getClientOriginalName();
            return $request->file($fieldName)->storeAs($directory, $filename, 'public');
        }
        return null;
    }

    private function deleteOldFile($filePath)
    {
        if (!empty($filePath) && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
