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
use Carbon\Carbon;

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
    
    public function update(UpdateStudentRequest $request, Student $student)
    {
        
        if (Carbon::parse($request->updated_at)->timestamp !== $student->updated_at->timestamp) {
            return back()->withErrors([
                'conflict' => 'This record was updated by someone else. Please refresh the page and try again.'
            ]);
        }
            
        $this->studentService->updateStudent($request, $student);
        
        if ($request->has('financialDetails')) {
            $this->studentService->updateFinancialDetails($request->input('financialDetails'), $student);
        }
    
        if ($request->has('studentEmployment')) {
            $this->studentService->updateStudentEmployment($request->input('studentEmployment'), $student);
        }
        
        $studentData = $student->toArray();
        $studentData['updated_at'] = $student->updated_at->toISOString();
            
        return inertia('Students/Edit', [
            'student' => $studentData,
            'message' => 'Student updated successfully!',
            ]);
        
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
