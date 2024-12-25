<?php

namespace App\Services;

use App\Contracts\Notifiable;
use App\Mail\SendMail;
use App\Models\Patient;
use App\Traits\MailableTrait;
use Illuminate\Support\Facades\Mail;

class MailService implements Notifiable
{

    use MailableTrait;

    /**
     * From Notifiable interface
     *
     * @param string $notificationAddress could be an email address or a phone number
     * @return void
     */
    public function notify(string $notificationAddress): void
    {
        Mail::to($notificationAddress)->send(new SendMail($this->createMail()));
    }

    /**
     * Sends a successful registration email to the patient.
     *
     * @param Patient $patient
     */
    public function sendSuccessfulRegisterMail(Patient $patient): void
    {
        $this->subject = "Welcome";
        $this->message = "Your account was successfully created";

        $this->notify($patient->email);
    }

}
