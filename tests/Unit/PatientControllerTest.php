<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PatientControllerTest extends TestCase
{

    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
    }

    #[Test] public function it_creates_a_patient_successfully(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('image.jpg');

        $payload = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '11235498',
            'address' => 'fake address',
            'document_photo' => $file,
        ];

        $response = $this->postJson('/api/patient', $payload);

        $response->assertStatus(201);

        Storage::disk('public')->assertExists('images/' . $file->hashName());

        $this->assertDatabaseHas('patients', [
            'name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '11235498',
            'address' => 'fake address',
            'document_photo' => '/storage/images/' . $file->hashName(),
        ]);
    }

    #[Test] public function it_fails_to_create_patient_with_duplicate_email()
    {
        $patientData = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '11235498',
            'address' => 'fake address',
            'document_photo' => UploadedFile::fake()->image('image.jpg'),
        ];

        $this->postJson('/api/patient', $patientData)->assertStatus(201);

        $this->postJson('/api/patient', $patientData)->assertStatus(422);
    }

    #[Test] public function it_fails_to_create_patient_with_no_complete_data()
    {
        $patientData = [
            'email' => 'test@test.com',
            'phone' => '11235498',
            'address' => 'fake address',
            'document_photo' => UploadedFile::fake()->image('image.jpg'),
        ];

        $this->postJson('/api/patient', $patientData)->assertStatus(422);
    }
}
