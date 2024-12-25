<?php

namespace App\Traits;

trait MailableTrait
{
    protected string $subject;
    protected string $message;

    /**
     * Creates the mail array with title and message properties.
     *
     * @return array
     */
    protected function createMail(): array
    {
        return [
            "subject" => $this->subject,
            "message" => $this->message
        ];
    }


}
