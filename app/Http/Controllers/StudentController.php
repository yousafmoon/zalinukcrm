<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use App\Services\FinancialDetailsService;
use App\Services\StudentEmploymentService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentController extends Controller
{
    use AuthorizesRequests;

    protected $studentService;
    protected $financialDetailsService;
    protected $StudentEmploymentService;

    public function __construct(StudentService $studentService, FinancialDetailsService $financialDetailsService, StudentEmploymentService $StudentEmploymentService)
    {
        $this->studentService = $studentService;
        $this->financialDetailsService = $financialDetailsService;
        $this->StudentEmploymentService = $StudentEmploymentService; 
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
    
        $financialDetails = $request->only([
            'own_property', 'bank_savings', 'tuition_budget', 'bank_funds', 'tuition_payer'
        ]);
        $studentEmployment = $request->input('StudentEmployment');

        if (!empty($financialDetails)) {
            $this->financialDetailsService->storeFinancialDetails($financialDetails, $student);
        }
    
        if (!empty($studentEmployment)) {
            $this->StudentEmploymentService->storeStudentEmployment($studentEmployment, $student);
        }
    
        return redirect()->route('students.index')->with('message', 'Student created successfully.');
    }
    
    
    

    public function edit(Student $student)
    {
        $this->authorize('update', $student);
        $studentData = $this->financialDetailsService->editFinancialDetails($student);

        return inertia('Students/Edit', [
            'student' => $studentData,
        ]);
    }
    

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('update', $student);
        $this->studentService->updateStudent($request, $student);
        $this->financialDetailsService->updateFinancialDetails($request->input('financial_details'), $student);
        return redirect()->route('students.index')->with('message', 'Student updated successfully.');
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
