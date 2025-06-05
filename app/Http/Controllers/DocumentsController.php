<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentsRequest;
use App\Http\Requests\UpdateDocumentsRequest;
use App\Http\Resources\DocumentsResource;
use App\Models\Documents;
use App\Models\Student;
use App\Services\DocumentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentsController extends Controller
{
    protected $documentsService;

    public function __construct(DocumentsService $documentsService)
    {
        $this->documentsService = $documentsService;
        $this->middleware('can:viewAny,App\Models\Documents');
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Documents::class);

        $documents = $this->documentsService->getDocuments($request->search);

        return inertia('Documents/Index', [
            'documents' => DocumentsResource::collection($documents),
            'search' => $request->search ?? '',
            'totalDocuments' => $documents->total(),
        ]);
    }


    public function show(Documents $document)
    {
    $document = $this->documentsService->editDocuments($document);
    $this->authorize('update', $document);
        $student = $document->student; 

        return inertia('Documents/View', [
            'documents' => $document,
            'student' => $student,
        ]);
    }



    public function create(Request $request)
    {
        $this->authorize('create', Documents::class);

        $studentId = $request->query('studentId');

        if (!$studentId) {
            return redirect()->back()->withErrors('Student ID is required.');
        }

        return inertia('Documents/Create', [
            'student_id' => $studentId,
        ])->with('success', 'Document created successfully!');
    }

    
    public function store(Request $request)
    {
        $document = Documents::create([
            'student_id' => $request->student_id,
        ]);

        foreach ($request->requiredDocuments as $docData) {
            $filePath = null;

            if (isset($docData['file']) && $docData['file'] instanceof \Illuminate\Http\UploadedFile) {
                $filePath = $docData['file']->store('documents', 'public');
            }

            $document->requiredDocuments()->create([
                'document_type' => $docData['document_type'],
                'file_name' => $docData['file_name'] ?? null,
                'file_path' => $filePath,
                
            ]);
        }

        return redirect()->route('documents.index')->with('success', 'Documents uploaded successfully.');
    }


    public function edit(Documents $document)
    {
        $this->authorize('update', $document);
        $document->load(['requiredDocuments']);

        $requiredDocumentsData = $document->requiredDocuments->map(function ($doc) {
            return [
                'id' => $doc->id,
                'document_type' => $doc->document_type,
                'file_name' => $doc->file_name,
                'original_name' => $doc->original_name,
                'file_path' => $doc->file_path,
                'uploaded_at' => $doc->uploaded_at,
                'file' => null,
            ];
        })->toArray();

        if (empty($requiredDocumentsData)) {
            $requiredDocumentsData[] = [
                'document_type' => '',
                'file_name' => '',
                'original_name' => '',
                'file_path' => '',
                'uploaded_at' => '',
                'file' => null,
            ];
        }

        $documentsData = $document->only([
            'id', 'student_id', 'document_type', 'file_name',
        ]);

        $documentsData['requiredDocuments'] = $requiredDocumentsData;

        return inertia('Documents/Edit', [
            'documents' => $documentsData,
            'message' => 'Student loaded successfully',
        ]);
    }


    public function update(UpdateDocumentsRequest $request, Documents $document)
    {
        $this->authorize('update', $document);

        $requestData = $request->validated();

        if (!empty($requestData['requiredDocuments'])) {
            foreach ($request->file('requiredDocuments', []) as $index => $fileArray) {

                if (is_array($fileArray) && isset($fileArray['file'])) {
                    $file = $fileArray['file'];
                    if ($file && $file->isValid()) {
                        $file->store('documents', 'public'); 
                        $requestData['requiredDocuments'][$index]['file_name'] = $file->getClientOriginalName();
                    }
                } elseif ($fileArray instanceof \Illuminate\Http\UploadedFile) {
                    $file = $fileArray;
                    if ($file->isValid()) {
                        $file->store('documents', 'public'); 
                        $requestData['requiredDocuments'][$index]['file_name'] = $file->getClientOriginalName();
                    }
                }
            }
            $this->documentsService->updateRequiredDocuments(
                $requestData['requiredDocuments'],
                $document,
                $request
            );
        }
        $this->documentsService->updateDocuments($requestData, $document);
        return redirect()->route('documents.edit', $document->id)
                        ->with('success', 'Documents updated successfully');
    }


   public function destroy(Documents $document)
    {
        $this->authorize('delete', $document);
        $this->documentsService->deleteDocuments($document);
        return redirect()->route('documents.index')->with('message', 'Document deleted successfully.');
    }

    public function dashboard()
    {
        return inertia('Dashboard', [
            'documents' => Documents::paginate(10),
            'auth' => auth()->user(),
        ]);
    }
}
