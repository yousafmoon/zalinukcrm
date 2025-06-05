<?php
namespace App\Services;

use App\Models\Documents;
use App\Models\Student;
use App\Repositories\DocumentsRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request; 
use App\Models\RequiredDocuments; 

class DocumentsService
{
    protected DocumentsRepository $documentsRepository;

    public function __construct(DocumentsRepository $documentsRepository)
    {
        $this->documentsRepository = $documentsRepository;
    }

   public function storeDocuments(array $data)
{
    return $this->documentsRepository->saveDocuments($data);
}


   public function storeRequiredDocument(array $data)
    {
        return RequiredDocuments::create($data);
    }

    public function updateDocuments(array $data, Documents $documents)
    {
        $documents->update([
            'student_id' => $data['student_id'] ?? $documents->student_id,
            'document_type' => $data['document_type'] ?? $documents->document_type,
            'file_name' => $data['file_name'] ?? $documents->file_name,
        ]);
    }


    public function updateRequiredDocuments(array $requiredDocuments, Documents $document, Request $request)
    {
        foreach ($requiredDocuments as $index => $doc) {
            $file = $request->file("requiredDocuments.$index.file");

            if (!empty($doc['id'])) {
                $existing = RequiredDocuments::where('id', $doc['id'])
                    ->where('document_id', $document->id)
                    ->first();

                if ($existing) {
                    $existing->document_type = $doc['document_type'] ?? $existing->document_type;
                    $existing->file_name = $doc['file_name'] ?? $existing->file_name;

                    if ($file) {
                        if ($existing->file_path && Storage::disk('public')->exists($existing->file_path)) {
                            Storage::disk('public')->delete($existing->file_path);
                        }
                        $path = $file->store('documents', 'public');
                        $existing->file_path = $path;
                    }

                    $existing->save();
                    continue;  
                }
            }

            if (!empty($doc['document_type']) || $file) {
                $new = new RequiredDocuments();
                $new->document_id = $document->id;
                $new->document_type = $doc['document_type'] ?? null;
                $new->file_name = $doc['file_name'] ?? null;

                if ($file) {
                    $path = $file->store('documents', 'public');
                    $new->file_path = $path;
                }

                $new->save();
            }
        }
    }

    public function deleteDocuments(Documents $document): void
    {
        $this->deleteRequiredDocumentsFiles($document);
        $document->delete();
    }

    protected function deleteRequiredDocumentsFiles(Documents $document): void
    {
        foreach ($document->requiredDocuments as $doc) {
            if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }
        }
    }

    public function getDocuments(?string $search = null)
    {
        return Documents::with(['student', 'requiredDocuments'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('requiredDocuments', fn($r) => 
                        $r->where('document_type', 'like', "%{$search}%")
                    )
                    ->orWhereHas('student', function ($s) use ($search) {
                        $s->where('firstname', 'like', "%{$search}%")
                        ->orWhere('middlename', 'like', "%{$search}%");
                    });
                });
            })
            ->paginate(20);
    }


    public function getDocumentsById($id): Documents
    {
        return Documents::with(['requiredDocuments', 'student'])->findOrFail($id);
    }


    public function editDocuments(Documents $document): Documents
    {
        return $document->load('requiredDocuments');
    }

}
