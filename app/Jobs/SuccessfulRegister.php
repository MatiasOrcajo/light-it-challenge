<?php

namespace App\Jobs;

use App\Models\Patient;
use App\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SuccessfulRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public Patient $patient;
    /**
     * Create a new job instance.
     */
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Execute the job.
     */
    public function handle(MailService $mailService): void
    {
        $mailService->sendSuccessfulRegisterMail($this->patient);

    }
}
