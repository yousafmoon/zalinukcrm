<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    public function middleware(): array
    {
        $this->middleware('permission:list students')->only('index');
        $this->middleware('permission:view students')->only('view', 'show');
        $this->middleware('permission:create students')->only('create', 'store');
        $this->middleware('permission:edit students')->only('edit', 'update');
        $this->middleware('permission:delete students')->only('destroy');
    }

    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Student::class); 
    
        $studentsQuery = Student::query()->orderBy('firstname', 'DESC');
        $this->applySearch($studentsQuery, $request->search);
    
        $students = StudentResource::collection($studentsQuery->paginate(10));
        return inertia('Students/Index', [
            'students' => $students,
            'search' => $request->search ?? '',
            'totalStudents' => $students->total(),
        ]);
        return response()->json([
            'data' => $students->items(), 
            'total' => $students->total(), 
            'per_page' => $students->perPage(),
            'current_page' => $students->currentPage(),
        ]);
    }
    protected function applySearch($query, $search)
    {
       return $query->when($search, function ($query, $search) {
            $query->where('firstname', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' .$search . '%')
            ->orWhere('passport_number', 'like', '%' . $search . '%')
            ->orWhere('nationality', 'like', '%' . $search . '%');

        });
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
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
    $data = $request->validated();

    if ($request->hasFile('fircopy')) {
        $data['fircopy'] = $this->handleFileUpload($request, 'fircopy', 'uploads/passport');
    }

    $student = Student::create($data);
    $this->syncOneToOneRelations($student, $request);
    $this->syncOneToManyRelations($student, $request);

    return redirect()->route('students.index')->with('message', 'Student created successfully.');
}

    
        
    public function edit(Student $student)
    {
        $this->authorize('update', $student); 
        return inertia('Students/Edit', [
            'student' => $student,
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('update', $student);
        $validatedData = $request->validated();
    
        if ($request->hasFile('fircopy')) {
            if ($student->fircopy && Storage::disk('public')->exists($student->fircopy)) {
                Storage::disk('public')->delete($student->fircopy);
            }
            $validatedData['fircopy'] = $this->handleFileUpload($request, 'fircopy', 'uploads/passport');
        }
    
        $student->update($validatedData);
        $this->syncOneToOneRelations($student, $request);
        $this->syncOneToManyRelations($student, $request);
    
        return redirect()->route('students.index')->with('message', 'Student updated successfully.');
    }
    
    private function handleFileUpload($request, $fieldName = 'fircopy', $directory = 'uploads/passport')
    {
        if ($request->hasFile($fieldName) && $request->file($fieldName)->isValid()) {
            $filename = time() . '-' . $request->file($fieldName)->getClientOriginalName();
            return $request->file($fieldName)->storeAs($directory, $filename, 'public');
        }
        return null;
    }
    
    
    private function syncOneToOneRelations(Student $student, Request $request)
    {
        $oneToOneRelations = [
            'financial_details' => 'FinancialDetails',
            'student_employment' => 'StudentEmployment',
            'income_details' => 'IncomeDetails',
            'contact_details' => 'ContactDetails',
            'parents_details' => 'ParentsDetails',
            'passport_details' => 'PassportDetails',
            'travel_details' => 'TravelDetails',
            'other_information_details' => 'OtherInformationDetails',
            'qualifications_details' => 'QualificationsDetails',
            'immigration_details' => 'ImmigrationDetails',
            'uk_visa_history_details' => 'UkVisaHistoryDetails',
            'overseas_travel_history_details' => 'OverseasTravelHistoryDetails',
            'spouse_partners_not_accompanying_details' => 'SpouseParnersNotAccompanyingDetails',
            'spouse_partners_accompanying_details' => 'SpouseParnersAccompanyingDetails',
            'requirements_for_europe_details' => 'RequirmentsForEuropeDetails',
            'documents_required' => 'DocumentsRequired',
            'check_copy_details' => 'CheckCopyDetails',
        ];

        foreach ($oneToOneRelations as $field => $relation) {
            if ($request->has($field)) {
                $student->$relation()->updateOrCreate(
                    ['student_id' => $student->id],
                    $request->input($field)
                );
                
            }
        }
    }

    private function syncOneToManyRelations(Student $student, Request $request)
    {
        $oneToManyRelations = [
            'references' => 'References',
            'childrens' => 'Childrens',
            'financial_documents' => 'FinancialDocuments',
        ];

        foreach ($oneToManyRelations as $field => $relation) {
            if ($request->has($field)) {
                $student->$relation()->delete();
                foreach ($request->input($field) as $item) {
                    $student->$relation()->create($item);
                }
            }
        }
    }

    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);     
        $student->delete();
        return redirect()->route('students.index')->with('message', 'Student deleted successfully.');
    }

    public function dashboard()
{
    return Inertia::render('Dashboard', [
        'students' => Student::paginate(10), 
        'auth' => auth()->user(),
    ]);
}

}