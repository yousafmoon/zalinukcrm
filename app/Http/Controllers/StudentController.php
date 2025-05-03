<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    use AuthorizesRequests;

    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function middleware(): array
    {
        $this->middleware('permission:list students')->only('index');
        $this->middleware('permission:view students')->only('view', 'show');
        $this->middleware('permission:create students')->only('create', 'store');
        $this->middleware('permission:edit students')->only('edit', 'update');
        $this->middleware('permission:delete students')->only('destroy');
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Student::class);
        $students = $this->studentService->getStudents($request->search);

        return inertia('Students/Index', [
            'students' => StudentResource::collection($students),
            'search' => $request->search ?? '',
            'totalStudents' => $students->total(),
        ]);
    }

    public function show($id)
    {
        $student = $this->studentService->getStudentById($id);
        return inertia('Students/View', compact('student'));
    }

    public function create()
    {
        $this->authorize('create', Student::class);
        return inertia('Students/Create');
    }

    public function store(StoreStudentRequest $request)
    {
        $this->authorize('create', Student::class);
        $student = $this->studentService->storeStudent($request);
        
        if (!$student || !$student->id) {
            return back()->with('error', 'Failed to create student.');
        }
    
        $financialDetails = $request->input('FinancialDetails');
        $studentEmployment = $request->input('StudentEmployment');
        
        if (!empty($financialDetails)) {
            $this->studentService->storeFinancialDetails($financialDetails, $student);
        }        
       if (!empty($studentEmployment)) {
            $this->studentService->storeStudentEmployment($studentEmployment, $student);
        }
    
        return redirect()->route('students.index')->with('message', 'Student created successfully.');
    }
    
    public function edit(Student $student)
    {
        $this->authorize('update', $student);
        $student->load(['financialDetails', 'studentEmployment']);

        $financialDefaults = [
            'own_property' => "No",
            'bank_savings' => "No",
            'tuition_budget' => "",
            'bank_funds' => "",
            'tuition_payer' => "",
        ];

        $financialData = $student->financialDetails
            ? array_merge($financialDefaults, $student->financialDetails->toArray())
            : $financialDefaults;

        $booleanFields = ['own_property', 'bank_savings'];
        foreach ($booleanFields as $field) {
            if (isset($financialData[$field])) {
                $financialData[$field] = ($financialData[$field] === 'yes' || $financialData[$field] === 1) ? 'Yes' : 'No';
            }
        }

        $employmentData = $student->studentEmployment
            ? $student->studentEmployment->toArray()
            : [];
        $studentData = $student->toArray();
        unset($studentData['financial_details']); 
        unset($studentData['student_employment']); 

    $studentData['financialDetails'] = $financialData;
        $studentData['studentEmployment'] = $employmentData;

        return inertia('Students/Edit', [
            'student' => $studentData,
        ]);
    }
    
    public function update(Student $student, UpdateStudentRequest $request)
    {
        
        Log::info('Update request received:', $request->all());
    
        $this->authorize('update', $student);
        if ($student->updated_at !== $request->input('updated_at')) {
            Log::warning('Conflict detected, timestamps do not match.');
            return response()->json(['error' => 'Conflict detected. Please refresh the page and try again.'], 409);
        }
    

        $this->studentService->updateStudent($request, $student);
    
        Log::info('Student after update:', $student->toArray());
    
        if ($request->has('financialDetails')) {
            $this->studentService->updateFinancialDetails($request, $student);
            Log::info('Financial details updated.');
        }
    
        if ($request->has('studentEmployment')) {
            $this->studentService->updateStudentEmployment($request, $student);
            Log::info('Student employment updated.');
        }
    
        return redirect()->route('students.edit', $student->id)
            ->with('success', 'Student updated successfully.');
    }
    
    
    
    
    
    
    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);
        $this->studentService->deleteStudent($student);
        return redirect()->route('students.index')->with('message', 'Student and all passport images deleted successfully.');
    }

    public function dashboard()
    {
        return inertia('Dashboard', [
            'students' => Student::paginate(10),
            'auth' => auth()->user(),
        ]);
    }
}
