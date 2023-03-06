<?php

namespace App\Mail\Invites;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class MailInviteProject extends Mailable
{
    use Queueable, SerializesModels;
    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from('klimushkin_test@mail.ru', $this->data['name'])
            ->subject($this->data['subject'])
            ->view('emails.invite_user_project')->with('data', $this->data);
    }
}
