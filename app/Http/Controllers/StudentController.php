<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;

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
        $data = $request->validated();
    
        if ($request->hasFile('fircopy')) {
            $data['fircopy'] = $request->file('fircopy')->store('uploads/passports', 'public');
        }
    
        Student::create($data);
    
        return response()->json(['message' => 'Student created successfully.']);
    }
    

    public function edit(Student $student)
    {
        $this->authorize('update', $student); 
        return inertia('Students/Edit', [
            'student' => new StudentResource($student),
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('update', $student); 
        $student->update($request->validated());
        return redirect()->route('students.index')->with('message', 'Student updated successfully.');
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