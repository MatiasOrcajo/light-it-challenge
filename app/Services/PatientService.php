<?php

namespace App\Services;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use Illuminate\Support\Facades\Storage;

class PatientService
{

    /**
     * Handles the creation of a new patient record with validated data.
     *
     * @param mixed $validated Validated request data
     * @return Patient.
     */
    public function create(mixed $validated): Patient
    {
        return Patient::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "phone" => $validated["phone"],
            "address" => $validated["address"],
            "document_photo" => $this->storeDocumentPhoto($validated["document_photo"]),
        ]);
    }

    /**
     * Stores the uploaded document photo in the public storage under the 'documents' directory.
     *
     * @param mixed $file The uploaded file instance to be stored
     * @return string The path where the file is stored
     */
    private function storeDocumentPhoto(mixed $file): string
    {
        return Storage::url($file->store('images', 'public'));
    }
}
