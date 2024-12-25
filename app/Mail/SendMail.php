<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public array $data;


    /**
     * @param array $data Data with mail content
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * Construct the email message with a subject and view.
     *
     * @return SendMail
     */
    public function build(): SendMail
    {
        return $this->subject($this->data["subject"])->view('mail.send-mail');
    }


}
