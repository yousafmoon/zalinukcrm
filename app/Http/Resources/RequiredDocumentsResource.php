<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DocumentsResource;



class RequiredDocumentsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'document_type' => $this->document_type,
            'file_name' => $this->file_name,
            'original_name' => $this->original_name,
            'file_path' => $this->file_path,
            'uploaded_at' => $this->uploaded_at,
            'file' => $this->file,
            'documents' => DocumentsResource::collection($this->whenLoaded('documents')),
        ];
    }
}
