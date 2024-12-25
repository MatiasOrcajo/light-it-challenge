<?php

namespace Tests\Unit;

use App\Mail\SendMail;
use App\Models\Patient;
use App\Services\MailService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MailServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    #[Test] public function it_sends_successful_register_mail()
    {
        $patient = new Patient(['email' => 'patient@example.com']);
        $mailService = new MailService();

        $mailService->sendSuccessfulRegisterMail($patient);

        Mail::assertSent(SendMail::class, function ($mail) use ($patient) {
            return $mail->hasTo($patient->email);
        });
    }
}
