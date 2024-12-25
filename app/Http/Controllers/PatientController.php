<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Jobs\SuccessfulRegister;
use App\Services\PatientService;
use Illuminate\Http\JsonResponse;

class PatientController extends Controller
{

    public function __construct(private readonly PatientService $patientService)

    {}

    /**
     * Handles the creation of a new patient record and dispatch job for email sending.
     *
     * @param PatientRequest $patientRequest The request containing patient data.
     *
     * @return JsonResponse JSON response with the created patient data and status code 201.
     */
    public function create(PatientRequest $patientRequest): JsonResponse
    {
        $validated = $patientRequest->validated();
        $patient = $this->patientService->create($validated);

        SuccessfulRegister::dispatch($patient);

        return response()->json($patient, 201);

    }
}
