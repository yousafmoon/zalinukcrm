<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class StudentController extends Controller
{
    protected $studentService;

        public function __construct(StudentService $studentService)
        {
             $this->studentService = $studentService;
            $this->middleware('can:viewAny,App\Models\Student');
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

        return inertia('Students/View', [
            'student' => $student,
        ]);
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
        $incomeDetails = $request->input('IncomeDetails');
        $studentReferences = $request->input('studentReferences');

        if (!empty($financialDetails)) {
            $this->studentService->storeFinancialDetails($financialDetails, $student);
        }

        if (!empty($studentEmployment)) {
            $this->studentService->storeStudentEmployment($studentEmployment, $student);
        }

         if (!empty($incomeDetails)) {
            $this->studentService->storeIncomeDetails($incomeDetails, $student);
        }

         if (!empty($studentReferences)) {
            $this->studentService->storestudentReferences($studentReferences, $student);
        }

        return redirect()->route('students.index')->with('message', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        $this->authorize('update', $student);

        $student->load(['financialDetails', 'studentEmployment', 'incomeDetails', 'studentReferences']);

        $financialDefaults = [
            'own_property'     => '',
            'bank_savings'     => '',
            'tuition_budget'   => '',
            'bank_funds'       => '',
            'tuition_payer'    => '',
        ];

        $financialData = $student->financialDetails
            ? array_merge($financialDefaults, $student->financialDetails->toArray())
            : $financialDefaults;

        $booleanFields = ['own_property', 'bank_savings'];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($financialData[$field] ?? ''));
            $financialData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }

        $employmentDefaults = [
            'personal_circumstances' => '',
            'employment_details'     => '',
            'present_work'           => '',
            'company_name'           => '',
            'job_start_date'         => '',
            'work_address'           => '',
            'employer_phone'         => '',
            'employer_email'         => '',
            'additional_jobs'        => '',
        ];

        $employmentData = [];

        if ($student->studentEmployment && $student->studentEmployment->count()) {
            foreach ($student->studentEmployment as $employment) {
                $employmentData[] = array_merge($employmentDefaults, $employment->toArray());
            }
        } else {
            $employmentData[] = $employmentDefaults;
        }

           $incomeDefaults = [
            'monthly_income'     => '',
            'income_from_others'     => '',
            'other_income_sources'   => '',
            'monthly_income_given_to_family' => '',
            'monthly_living_costs'    => '',
        ];

        $incomeData = $student->incomeDetails
            ? array_merge($incomeDefaults, $student->incomeDetails->toArray())
            : $incomeDefaults;

        $booleanFields = ['income_from_others', 'other_income_sources'];
        foreach ($booleanFields as $field) {
            $value = strtolower(trim($incomeData[$field] ?? ''));
            $incomeData[$field] = ($value === 'yes') ? 'Yes' : 'No';
        }

          $studentReferencesDefaults = [
            'name' => '',
            'phone'  => '',
            'email'  => '',
            'position' => '',
            'relationship' => '',
            'duration' => '',
        ];

        $referencesData = [];

        if ($student->studentReferences && $student->studentReferences->count()) {
            foreach ($student->studentReferences as $reference) {
                $referencesData[] = array_merge($studentReferencesDefaults, $reference->toArray());
            }
        } else {
            $referencesData[] = $studentReferencesDefaults;
        }

        $studentData = $student->toArray();
        unset($studentData['financial_details'], $studentData['student_employment'], $studentData['income_details'], 
        $studentData['student_references']);

        $studentData['financialDetails']  = $financialData;
        $studentData['studentEmployment'] = $employmentData;
        $studentData['incomeDetails'] = $incomeData;
        $studentData['studentReferences'] = $referencesData;

        return inertia('Students/Edit', [
            'student' => $studentData,
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('update', $student);

        $requestData = $request->validated();

        $this->studentService->updateStudent($requestData, $student);

        if ($request->has('financialDetails')) {
            $this->studentService->updateFinancialDetails($request->input('financialDetails'), $student);
        }

        if ($request->has('studentEmployment')) {
            $this->studentService->updateStudentEmployment($request->input('studentEmployment'), $student);
        }

        if ($request->has('incomeDetails')) {
            $this->studentService->updateIncomeDetails($request->input('incomeDetails'), $student);
        }

         if ($request->has('studentReferences')) {
            $this->studentService->updatestudentReferences($request->input('studentReferences'), $student);
        }

        return inertia('Students/Edit', [
            'student' => $student, 
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
