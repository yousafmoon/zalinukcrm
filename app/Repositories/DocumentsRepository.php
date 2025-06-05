<?php
namespace App\Repositories;

use App\Models\Documents;
use Illuminate\Http\UploadedFile;

class DocumentsRepository
{
  public function saveDocuments(array $data, Documents $documents = null): Documents
{
    $documents = $documents ?? new Documents();

    if (empty($data['student_id'])) {
        throw new \Exception("Student ID is required to create a document.");
    }

    $documentsFields = array_filter($data, fn($value, $key) =>
        $key !== 'requiredDocuments' && $value !== null,
        ARRAY_FILTER_USE_BOTH
    );

    $documents->fill($documentsFields);
    $documents->save();

    if (!empty($data['requiredDocuments']) && is_array($data['requiredDocuments'])) {
        $this->saveRequiredDocuments($documents, $data['requiredDocuments']);
    }

    return $documents;
}


   public function saveRequiredDocuments(Documents $documents, array $documentsData): void
    {
        $existingIds = [];

        foreach ($documentsData as $document) {
            $docId = $document['id'] ?? null;

            if (!empty($document['file']) && $document['file'] instanceof UploadedFile) {
                $document['file_path'] = $document['file']->store('documents', 'public');
                $document['file_name'] = $document['file']->hashName();
                $document['original_name'] = $document['file']->getClientOriginalName();
                $document['uploaded_at'] = now();
            }

            unset($document['file']);
            $filteredData = array_filter($document, fn($value) => $value !== null && $value !== '');

            if (!empty($filteredData)) {
                if ($docId) {
                    $documents->requiredDocuments()->where('id', $docId)->update($filteredData);
                    $existingIds[] = $docId;
                } else {
                    $new = $documents->requiredDocuments()->create($filteredData);
                    $existingIds[] = $new->id;
                }
            }
        }

        $documents->requiredDocuments()->whereNotIn('id', $existingIds)->delete();
    }


}
